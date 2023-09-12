<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\DoModel;
use App\Events\OeeEvent;
use App\Models\LogMesin;
use App\Models\NotifMesin;
use App\Models\OeeService;
use Illuminate\Http\Request;
use App\Models\RealTimeMesin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\QueryException;

class StartServiceController extends Controller
{
    public function run()
    {
        $bool = true;
        while ($bool) {
            $oee =  OeeService::get();
            if (count($oee) > 0) {
                DB::beginTransaction();
                $event_arr = [];
                foreach ($oee as $key => $req) {
                    try {
                        $endpoint = env('ENDPOINT_URL');
                        // GET STATUS MESIN
                        $response = Http::get("{$endpoint}/mesin?mesinId={$req->mesin_id}&nomorDo={$req->no_do}");
                        $data = $response->object();

                        $rtm = RealTimeMesin::with(['do', 'mesin'])->where('mesin_id', $req->mesin_id)->where('no_do', $req->no_do)->first();
                        if (!$rtm) {
                            DB::rollback();

                            $event_arr[] = [
                                'msg' => 'error',
                                'desc' => 'No data available in table',
                                'mesin_id' => $req->mesin_id
                            ];
                        }
                        $do = DoModel::where('no_do', $req->no_do)->first();

                        if ($data->Buzzer == 0 && ($data->statusMesin == 'stop' && $data->mode == 'produksi') && $rtm->status != 'downtime') {

                            DB::rollback();

                            $event_arr[] = [
                                'msg' => 'success',
                                'code' => 'stop_produksi',
                                'desc' => "This {$rtm->mesin->name} has not been started, has it been started?",
                                'oee' => $data,
                                'target' => $rtm->target,
                                'nama_mesin' => $rtm->mesin->name,
                                'operator' => $rtm->operator,
                                'status' => $rtm->status,
                                'mesin_id' => $req->mesin_id,
                                'time' => date("Y-m-d H:i:s", strtotime($rtm->created_at))
                            ];
                        } else if ($data->Buzzer == 0 && ($data->statusMesin == 'running' && $data->mode == 'produksi') && $rtm->status != 'downtime') {
                            $rtm->status = $data->mode;
                            $rtm->actual = $data->actual == null ? 0 : $data->actual;
                            $rtm->ng = $data->notGood == 'NaN' ? 0 : $data->notGood;
                            $rtm->cycle_time = $data->cycleTime;
                            $rtm->update();

                            $do->actual = $data->actual == null ? 0 : $data->actual;
                            $do->ng = $data->notGood == 'NaN' ? 0 : $data->notGood;
                            $do->update();

                            DB::commit();

                            $event_arr[] = [
                                'msg' => 'success',
                                'code' => 'running',
                                'desc' => "This {$rtm->mesin->name} has been started and is working on production.",
                                'oee' => $data,
                                'target' => $rtm->target,
                                'nama_mesin' => $rtm->mesin->name,
                                'operator' => $rtm->operator,
                                'status' => $rtm->status,
                                'mesin_id' => $req->mesin_id,
                                'time' => date("Y-m-d H:i:s", strtotime($rtm->created_at))
                            ];
                        } else if ($data->Buzzer == 1 && ($data->statusMesin == 'stop' && $data->mode == 'produksi') && $rtm->status != 'downtime') {

                            $lm = new LogMesin();
                            $date_time = date('Y-m-d H:i:s');

                            $lm_update = LogMesin::where('no_do', $req->no_do)->whereNull('log_time_stop')->first();
                            $start = new DateTime($lm_update->log_time_start);
                            $end = new DateTime($date_time);
                            $durasi = $start->diff($end);
                            $format_durasi = $durasi->format('%H:%i:%s');

                            $nm = new NotifMesin();
                            $nm->no_do = $req->no_do;
                            $nm->mesin_id = $req->mesin_id;
                            $nm->mesin_name = $rtm->mesin->name;
                            $nm->do_name = $rtm->do->name;
                            $nm->status = 'pending';
                            $nm->time_start = $date_time;
                            $nm->save();

                            $rtm->status = 'downtime';
                            $rtm->actual = $data->actual == null ? 0 : $data->actual;
                            $rtm->ng = $data->notGood == 'NaN' ? 0 : $data->notGood;
                            $rtm->cycle_time = $data->cycleTime;
                            $rtm->update();

                            $lm_update->log_time_stop = $date_time;
                            $lm_update->duration = $format_durasi;
                            $lm_update->update();

                            $lm->realtime_mesin_id = $rtm->id;
                            $lm->no_do = $req->no_do;
                            $lm->log_time_start = $date_time;
                            $lm->status = 'downtime';
                            $lm->type = 'downtime';
                            $lm->created_by = 'admin';
                            $lm->save();

                            DB::commit();

                            $event_arr[] = [
                                'msg' => 'success',
                                'code' => 'stop_perbaikan',
                                'triger' => 2,
                                'desc' => "This {$rtm->mesin->name} is off, please check the machine and notify whether it is being repaired or finished.",
                                'oee' => $data,
                                'target' => $rtm->target,
                                'nama_mesin' => $rtm->mesin->name,
                                'operator' => $rtm->operator,
                                'status' => $rtm->status,
                                'mesin_id' => $req->mesin_id,
                                'time' => date("Y-m-d H:i:s", strtotime($rtm->created_at))
                            ];
                        } else if ($data->Buzzer == 1 && ($data->statusMesin == 'stop' && $data->mode == 'produksi') && $rtm->status == 'downtime') {
                            DB::rollback();

                            $event_arr[] = [
                                'msg' => 'success',
                                'code' => 'downtime',
                                'triger' => 1,
                                'desc' => "This {$rtm->mesin->name} is stopped.",
                                'oee' => $data,
                                'target' => $rtm->target,
                                'nama_mesin' => $rtm->mesin->name,
                                'operator' => $rtm->operator,
                                'status' => $rtm->status,
                                'mesin_id' => $req->mesin_id,
                                'time' => date("Y-m-d H:i:s", strtotime($rtm->created_at))
                            ];
                        } else if ($data->Buzzer == 0 && ($data->statusMesin == 'stop' && $data->mode == 'Finish') && $rtm->status != 'downtime') {
                            OeeService::where('mesin_id', $req->mesin_id)->where('no_do', $req->no_do)->delete();

                            DB::commit();

                            $event_arr[] = [
                                'msg' => 'success',
                                'code' => 'stop_finish',
                                'desc' => "This {$rtm->mesin->name} is finished.",
                                'oee' => $data,
                                'target' => $rtm->target,
                                'nama_mesin' => $rtm->mesin->name,
                                'operator' => $rtm->operator,
                                'status' => $rtm->status,
                                'mesin_id' => $req->mesin_id,
                                'time' => date("Y-m-d H:i:s", strtotime($rtm->created_at))
                            ];
                        } else if ($data->Buzzer == 0 && ($data->statusMesin == 'stop' && $data->mode == 'perbaikan') && $rtm->status != 'downtime') {
                            DB::rollback();

                            $event_arr[] = [
                                'msg' => 'success',
                                'code' => 'perbaikan',
                                'desc' => "This {$rtm->mesin->name} is under maintenance.",
                                'oee' => $data,
                                'target' => $rtm->target,
                                'nama_mesin' => $rtm->mesin->name,
                                'operator' => $rtm->operator,
                                'status' => $rtm->status,
                                'mesin_id' => $req->mesin_id,
                                'time' => date("Y-m-d H:i:s", strtotime($rtm->created_at))
                            ];
                        } else {
                            DB::rollback();

                            $event_arr[] = [
                                'msg' => 'error',
                                'desc' => 'System error please contact the Support team',
                                'mesin_id' => $req->mesin_id
                            ];

                            Log::info([
                                'msg' => 'error',
                                'desc' => 'System error please contact the Support team',
                                'mesin_id' => $req->mesin_id
                            ]);
                        }
                    } catch (QueryException $th) {
                        DB::rollback();


                        $event_arr[] = [
                            'msg' => 'error',
                            'desc' => $th->getMessage(),
                            'mesin_id' => $req->mesin_id
                        ];

                        Log::info([
                            'msg' => 'error',
                            'desc' => $th->getMessage(),
                            'mesin_id' => $req->mesin_id
                        ]);
                    } catch (\Throwable $th) {
                        DB::rollback();


                        $event_arr[] = [
                            'msg' => 'error',
                            'desc' => $th->getMessage(),
                            'mesin_id' => $req->mesin_id
                        ];

                        Log::info([
                            'msg' => 'error',
                            'desc' => $th->getMessage(),
                            'mesin_id' => $req->mesin_id
                        ]);
                    }
                }
                $bool = true;
                OeeEvent::dispatch($event_arr);
                return $bool;
            } else {
                $bool = false;
                Log::info('Data tidak ditemukan ' . date('Y-m-d H:i:s'));
                return $bool;
            }
            // Pause for 1 second
            sleep(1);
        }
    }
}
