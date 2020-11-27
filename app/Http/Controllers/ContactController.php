<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contacts;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $contacts = Contacts::all();
        $userId = Auth::id();
        $contacts = Contacts::where('user_id','=',$userId)->paginate(5);
        return view('contacts',compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $rules = [
			'name' => 'required|string|min:3|max:255',
			'email' => 'required|string|email|max:255'
		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect('home')
			->withInput()
			->withErrors($validator);
		}
		else{
            $data = $request->input();
			try{
                $userId = Auth::id();

				$contact = new Contacts;
                $contact->user_id       = $userId;
                $contact->name          = $data['name'];
                $contact->company       = $data['company'];
                $contact->phone         = $data['phone'];
                $contact->email         = $data['email'];
				$contact->save();
                // return redirect('home')->with('status',"Insert successfully");
                return redirect()->back()->with('message', 'Insert successfully');
			}
			catch(Exception $e){
				return redirect('home')->with('failed',"operation failed");
			}
		}
    }

    public function search(Request $request)
    {
        if($request->ajax())
        {
            $userId = Auth::id();
            $output="";
            $contacts = DB::table('contacts')->where('name','LIKE','%'.$request->search."%")->where('user_id','=',$userId)->paginate(5);
            if($contacts)
            {
                foreach ($contacts as $key => $contact) {
                $output.='<tr>'.
                '<td>'.$contact->id.'</td>'.
                '<td>'.$contact->name.'</td>'.
                '<td>'.$contact->company.'</td>'.
                '<td>'.$contact->phone.'</td>'.
                '<td>'.$contact->email .'</td>'.
                '<td>'. '<a href="">Edit</a> | <a href="">Delete</a>' .'</td>'.
                '</tr>';
            }
            return Response($output);
            }
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contacts = DB::table('contacts')->where('id','=',$id)->get();

        return view('edit_contact',compact('contacts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->input();
        $id = $data['id'];

        $update = DB::table('contacts')
                        ->where('id', $id)
                        ->update([
                                'name'          => $data['name'],
                                'company'       => $data['company'],
                                'phone'         => $data['phone'],
                                'email'         => $data['email'],
                                ]); 

        return redirect('/contacts');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \DB::table("contacts")->delete($id);
        return redirect()->back()->with('success','contact deleted');
    }

    public function thankyou(){
        return view('thankyou');
    }
}
