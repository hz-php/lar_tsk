<?php

namespace App\Http\Controllers\Workers;

use App\Events\WorkerCreate;
use App\Http\Controllers\Controller;
use App\Models\Workers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class WorkerController extends Controller
{
    public function index()
    {
        Redis::pipeline(function ($pipe) {
            $workers = \DB::table('workers')->paginate(150);
            foreach ($workers as $worker) {
                $pipe->set("key:$worker->id", $worker->first_name);
                $pipe->set("last_name:$worker->id", $worker->last_name);
                $pipe->set("role:$worker->id", $worker->role);

//                Cache::tags('first_name', 'last_name', 'role')->put('Worker', $worker->first_name.$worker->last_name.$worker->role, 10000);
            }
        });
        /*
         * Получение тегированого кэша
        $all = Cache::tags('first_name', 'last_name', 'role')->get('Worker');
        */
        for ($i = 0; $i < 150; $i++) {
            if (Redis::EXISTS("key:$i") && Redis::EXISTS("last_name:$i") && Redis::EXISTS("role:$i")) {
                $workers[] = [
                    'first_name' => Redis::get("key:$i"),
                    'last_name' => Redis::get("last_name:$i"),
                    'role' => Redis::get("role:$i"),
                ];
            } else {
                $workers_std = \DB::table('workers')->paginate(150);
                foreach ($workers_std as $worker) {
                    $workers[] = [
                        'first_name' => $worker->first_name,
                        'last_name' => $worker->last_name,
                        'role' => $worker->role,
                    ];
                }
            }

        }

        return view('worker.index', compact('workers'));
    }

    public function create()
    {
        return view('worker.create');
    }
    public function store(Request $request)
    {

        $worker = new Workers();
        $worker->first_name = $request->input('first_name');
        $worker->last_name = $request->input('last_name');
        $worker->company = $request->input('company');
        $worker->role = $request->input('role');
        $worker->number = $request->input('number');
        $worker->series = $request->input('series');
        $worker->birthday = $request->input('birthday');
        if ($worker->save()) {
            event(new WorkerCreate($worker));
            return redirect(route('worker_index'));
        }
    }
}
