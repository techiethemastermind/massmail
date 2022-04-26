<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use App\Jobs\SendEmailJob;
use App\Models\User;
use Artisan;

class SubscriberController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * List subscribers
     */
    public function index()
    {
        $items = Subscriber::paginate(50);
        return view('dashboard.subscriber.index', compact('items'));
    }

    /**
     * Add new email by manually
     */
    public function create()
    {
        return view('dashboard.subscriber.create');
    }

    /**
     * Store new subscriber
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|string|unique:subscribers,email',
            'name'  => 'required|string'
        ]);

        try {
            Subscriber::create($data);

            return response()->json([
                'success' => true
            ]);

        } catch (\Exception $e) {
            
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Change Status
     */
    public function chageStatus(Request $request)
    {
        $rlt = Subscriber::where('id', $request->id)->update(['status' => $request->status]);
        
        return response()->json([
            'success' => true
        ], 200);
    }

    /**
     * Delete a Subscriber
     */
    public function destroy($id)
    {
        Subscriber::where('id', $id)->delete();

        return response()->json([
            'success' => true
        ], 200);
    }

    public function sendEmail()
    {
        $items = Subscriber::where('status', 1)
            ->where('mail_sent', 0)
            ->get();

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
            $name  = 'Customer';
            
            if ($email != '') {
                $subscribers = Subscriber::where('email', $email)->count();

                if($subscribers < 1) {
    
                    $insertData = [
                        'name'  => $name,
                        'email' => $email
                    ];
    
                    Subscriber::create($insertData);
                }
            }
        }

        return response()->json([
            'success' => true
        ], 200);
    }

    public function runJob()
    {
        Artisan::call('queue:work', ['--stop-when-empty' => true]);

        return response()->json([
            'success' => true
        ], 200);
    }
}
