<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use App\Jobs\SendEmailJob;
use App\Models\User;

class SubscriberController extends Controller
{
    // List subscribers
    public function index()
    {
        $items = Subscriber::paginate(25);
        return view('dashboard.subscriber.index', compact('items'));
    }

    public function sendEmail()
    {
        $items = Subscriber::all();

        // set job status
        // $user_record = User::find(auth()->user()->id);
        // $user_record->job_status = 1;
        // $user_record->save();

        // Sending Emails
        foreach($items as $item) {
            $details['email'] = $item->email;
            $details['name']  = $item->name;            
            dispatch(new SendEmailJob($details));
        }

        return response()->json([
            'success' => true,
            'message' => 'Mail Send Successfully!!'
        ]);
    }

    public function csvImport(Request $request)
    {
        if(!$request->file('csv_file')) {
            return response()->json([
                'success' => false,
                'message' => 'File not attached'
            ]);
        }

        $path = $request->file('csv_file')->getRealPath();
        $data = array_map('str_getcsv', file($path));

        foreach($data as $item) {
            $email = trim($item[0]);
            $subscribers = Subscriber::where('email', $email)->count();

            if($subscribers < 1) {

                $insertData = [
                    'email' => $email,
                    'name'  => 'customer'
                ];

                Subscriber::create($insertData);
            }
        }

        return response()->json([
            'success' => true
        ], 200);
    }
}
