<?php

namespace App\Http\Controllers\admin;

use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
     /**
     * Display a listing of the schedules.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedule::all();
        return view('admin.schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new schedule.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.schedules.create');
    }

    /**
     * Store a newly created schedule in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'title' => 'required|string',
            'start_datetime' => 'required|',
            'end_datetime' => 'required|',
            'late_time' => 'required|',
            'half_day_time' => 'required|',

        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            $schedule =  new Schedule();
            $schedule->title =  $request->title;
            $schedule->start_datetime =  $request->start_datetime;
            $schedule->end_datetime =  $request->end_datetime;
            $schedule->late_time =  $request->late_time;
            $schedule->half_day_time =  $request->half_day_time;
            $schedule->save();
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
        return redirect()->route('schedules.index')
            ->with('success', 'Schedule created successfully.');
    }

    /**
     * Display the specified schedule.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view('admin.schedules.show', compact('schedule'));
    }

    /**
     * Show the form for editing the specified schedule.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view('admin.schedules.edit', compact('schedule'));
    }

    /**
     * Update the specified schedule in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $rules = [
            'title' => 'required|string',
            'start_datetime' => 'required|',
            'end_datetime' => 'required|',
            'late_time' => 'required|',
            'half_day_time' => 'required|',
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            $schedule = Schedule::findOrFail($id);
            $schedule->title =  $request->title;
            $schedule->start_datetime =  $request->start_datetime;
            $schedule->end_datetime =  $request->end_datetime;
            $schedule->late_time =  $request->late_time;
            $schedule->half_day_time =  $request->half_day_time;
            $schedule->save();
        } else {

            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        return redirect()->route('schedules.index')
            ->with('success', 'Schedule updated successfully.');
    }

    /**
     * Remove the specified schedule from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('schedules.index')
            ->with('success', 'Schedule deleted successfully.');
    }
}
