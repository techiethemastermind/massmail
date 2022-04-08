<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use App\Mail\SendEmail;
use Mail;

class TemplateController extends Controller
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
     * List Email Templates
     */
    public function index()
    {
        $templates = EmailTemplate::all();
        return view('dashboard.template.index', compact('templates'));
    }

    /**
     * Create a New Email Template
     */
    public function create()
    {
        $header = EmailTemplate::where('slug', 'header')->first();
        $footer = EmailTemplate::where('slug', 'footer')->first();
        return view('dashboard.template.create', compact('header', 'footer'));
    }

    /**
     * Edit Email Template
     */
    public function edit($id)
    {
        $header = EmailTemplate::where('slug', 'header')->first();
        $footer = EmailTemplate::where('slug', 'footer')->first();
        $template = EmailTemplate::find($id);
        return view('dashboard.template.edit', compact('template', 'header', 'footer'));
    }

    /**
     * Store a new Email Template
     */
    public function store(Request $request)
    {
        $data = [
            'name' => 'contact',
            'slug' => 'contact',
            'subject' => $request->subject,
            'content' => $request->content,
            'html_content' => $request->html_content,
            'published' => 0,
            'type' => 1
        ];
        $template = EmailTemplate::create($data);
        return redirect()->route('mailedits.edit', $template->id);
    }

    /**
     * Update a Email Template
     */
    public function update(Request $request, $id)
    {
        $template = EmailTemplate::find($id);

        $template->html_content = $request->html_content;
        $template->name = 'contact';
        $template->slug = 'contact';
        $template->subject = $request->subject;
        $template->content = $request->content;
        $template->save();

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Publish email template
     */
    public function publish(Request $request)
    {
        EmailTemplate::where('published', 1)->update(['published' => 0]);
        EmailTemplate::find($request->id)->update(['published' => $request->published]);

        if ($request->published == 1) {
            $message = 'Successfully published';
        } else {
            $message = 'Successfully Unpublished';
        }

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }

    /**
     * Send Test Email
     */
    public function sendTestEmail(Request $request)
    {
        $data = [
            'type' => 'test',
            'template_id' => $request->template_id,
            'email' => $request->email
        ];

        try {
            Mail::to($data['email'])->send(new SendEmail($data));

            return response()->json([
                'success' => true
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
