<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $counters = Counter::where([]);
        if ($request->has('search'))
            $counters = $counters->where('counter_number', 'like', "%{$request->input('search')}%")
            ->orWhere('subscription_number', 'like', "%{$request->input('search')}%")
            ->orWhere('subscriber', 'like', "%{$request->input('search')}%")
            ->orWhere('current_read', 'like', "%{$request->input('search')}%")
            ->orWhere('previous_read', 'like', "%{$request->input('search')}%");

        $counters = $counters->orderBy('number', 'ASC')->paginate(5);
        return view('counters.index',compact('counters'));
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('counters.create');
    }
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required', 
            'position_number' => 'required', 
            'subscription_number'=> 'required', 
            'subscriber'=> 'required', 
            'counter_number'=> 'required', 
        ]);
        $counter= Counter::create($request->all());
        if($request->current_read == null) $counter->current_read = 0; 
        if($request->cups_consumption == null) $counter->cups_consumption = 0; 
        if($request->shekels_consumption == null) $counter->shekels_consumption = 0; 
        $counter-> save();
        return redirect()->route('counters.index')
                        ->with('success','تم إضافة العداد بنجاح');
    }
   
    /**
     * Display the specified resource.
     *
     * @param  \App\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function show(Counter $counter)
    {
        return view('counters.show',compact('counter'));
    }
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function edit(Counter $counter)
    {
        return view('counters.edit',compact('counter'));
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Counter $counter)
    {
        $request->validate([
            'number' => 'required', 
            'position_number' => 'required', 
            'subscription_number'=> 'required', 
            'subscriber'=> 'required', 
            'counter_number'=> 'required',
            'previous_read'=> 'required',  
            'current_read'=> 'required', 
            'cups_consumption'=> 'required',  
            'shekels_consumption'=> 'required', 
        ]);
  
        $counter->fill($request->all());
        $def = $request->current_read -  $request->previous_read;
        if($def >= 0) {
            $counter->cups_consumption = $def;
            $counter->shekels_consumption = (($def < 11) ? 20 : $def*2);
        }
        else {
            $counter->cups_consumption = 0;
            $counter->shekels_consumption = 0;
        }
        $counter->save();
        return redirect()->route('counters.index')
                        ->with('success','تم تعديل القراءة بنجاح');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Counter $counter)
    {
        $counter->delete();
  
        return redirect()->route('counters.index')
                        ->with('success','تم الحذف بنجاح');
    }

    public function refresh()
    {
        $counters = Counter::get();
        foreach($counters as $counter){
            if($counter->current_read != 0) $counter->previous_read = $counter->current_read;
            $counter->current_read = 0;
            $counter->cups_consumption = 0;
            $counter->shekels_consumption = 0;
            $counter->save();
        }
     
        return redirect()->route('counters.index')
        ->with('success','تم تصفير العدادات');    
    }
}
