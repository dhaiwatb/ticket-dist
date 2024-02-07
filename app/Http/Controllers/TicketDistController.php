<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketDist;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\DataTables\TicketDataTable;
use DataTables;

use Illuminate\Support\Facades\Storage;

class TicketDistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //return list view of ticket
        $tickets = TicketDist::all();
        return view('tickets/list', compact('tickets'));

        // return $datatable->render('tickets.list');

        // if ($request->ajax()) {
        //     $data = TicketDist::select('*');
        //     return Datatables::of($data)
        //             ->addIndexColumn()
        //             ->addColumn('action', function($row){
     
        //                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
    
        //                     return $btn;
        //             })
        //             ->rawColumns(['action'])
        //             ->make(true);
        // }
        
        return view('tickets/list');
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //view for create ticket
        return view('tickets/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'ticket_title' => 'required|unique:ticket_dists',
            'ticket_status' => 'required',
            'ticket_image' => 'required|mimes:jpg,jpeg,png'
        ]);

        if ($validator->fails()) {
            // Return errors or redirect back with errors
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if($request->hasFile('ticket_image')){
            TicketDist::create([
                'ticket_title' => $request->input('ticket_title'),
                'ticket_number' => Str::random(7),
                'status' => $request->input('ticket_status'),
                'ticket_image' => $request->file('ticket_image')->getClientOriginalName(),
                'desciption' => $request->input('description'),
            ]);

            $request->file('ticket_image')->storeAs('/tickets/', $request->file('ticket_image')->getClientOriginalName().'.'.$request->file('ticket_image')->getClientOriginalExtension());

            return redirect()->route('tickets.index');

        }
        else{
            return redirect()->back()->withInput()->with('message', 'Something went wrong');
        }
        // dd($request->hasFile('ticket_image'), $request->file('ticket_image'), $request->all());
        //store ticket and return to list
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //show ticket view
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ticket = TicketDist::find($id);
        // dd($ticket);
        return view('tickets/edit', ['ticket' => $ticket]);
        //edit ticket form view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ticket = TicketDist::where('id', $id)->update([    
            // 'ticket_title' => $request->input('ticket_title'),
            // 'ticket_number' => Str::random(7),
            'status' => $request->input('ticket_status'),
            'ticket_image' => $request->file('ticket_image')->getClientOriginalName(),
            'desciption' => $request->input('description'),
        ]);

        $request->file('ticket_image')->storeAs('/tickets/', $request->file('ticket_image')->getClientOriginalName().'.'.$request->file('ticket_image')->getClientOriginalExtension());

        return redirect()->route('tickets.index');
        //update ticket to database and return to list of tickets
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $ticket = TicketDist::where('id', $id)->delete();

        return redirect()->route('tickets.index');
    }
    public function datatables(TicketDataTable $dataTable)
    {
        return $dataTable->ajax();
    }

}
