<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Post;

class UpdatedPost extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * post instance
     */

    protected $post;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('prova@test.it')
                    ->subject('post updated ' . $this->post->title)
                    // ->view('mail.updated-post')
                    ->markdown('mail.updated-post')
                    ->with([
                        'title' => $this->post->title,
                        'slug' => $this->post->slug,
                        'body' => $this->post->body
                    ]);
    }
}
