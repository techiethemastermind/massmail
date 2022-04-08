<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\EmailTemplate;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->details = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if (isset($this->details['type'])) {
            $template = EmailTemplate::where('id', $this->details['template_id'])->first();
        } else {
            $template = EmailTemplate::where('slug', 'contact')->where('published', 1)->first();
        }
        
        $html_body = $template->html_content;
        $html_body = str_replace('{customer}', $this->details['name'], $html_body);
        $content = $this->getHeader() . $html_body . $this->getFooter();
        
        return $this->subject($template->subject)
            ->view('emails.sendEmail', compact('content'));
    }

    function getHeader()
    {
        $header = EmailTemplate::where('slug', 'header')->first();
        $header_view = view('emails.parts.header', ['header_html' => $header->html_content])->render();
        return $header_view;
    }

    function getFooter()
    {
        $footer = EmailTemplate::where('slug', 'footer')->first();
        $footer_view = view('emails.parts.footer', ['footer_html' => $footer->html_content])->render();
        return $footer_view;
    }
}
