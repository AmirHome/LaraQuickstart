<?php

function sendMail($email_template, $data, $subject, $to, $cc = [],$bcc = [], $attachment)
{
    
    /*
     * $to = ['amir.email@yahoo.com' => 'Amir Hosseinzadeh']
     * $cc = ['amir.email@yahoo.com' => 'Amir Hosseinzadeh']
     * $attachment = ['file'=> $pdf, 'file_name'=>'invoice.pdf']
     */
// dd($data);

    // try {
        \Mail::send($email_template, $data, function ($message) use ($to, $cc,$bcc, $subject, $attachment) {
            // dd(trim(env('MAIL_SENDER_EMAIL', 'sender_email')), trim(env('MAIL_SENDER_NAME', 'sender name')));
            $message->from(trim(env('MAIL_SENDER_EMAIL', 'sender_email')), trim(env('MAIL_SENDER_NAME', 'sender name')));

            foreach ($to as $email) {
                if (isset($email)) {
                    $message->to(trim($email), trim($email));
                }
            }
            foreach ($cc as $email) {
                if (isset($email)) {
                    $message->cc(trim($email));
                }
            }

            $message->sender(trim(env('MAIL_SENDER_EMAIL', 'sender_email')));
            $message->subject($subject);

/*            if (!empty($attachment)) {

                if ($attachment == 'data') {
                // dd($data['documents']);
                    foreach ($data['documents'] as $attachmentItem) {
                        $message->attach($attachmentItem->getRealPath(), [
        'as' => 'resume.' . $attachmentItem->getClientOriginalExtension(), 
        'mime' => $attachmentItem->getMimeType()]
                        );
                    }
                } else {
                    # for pdf dom
                    $message->attachData($attachment['file'], $attachment['file_name']);
                }
                
            }*/

        });
        // return ['status' => 'Success'];

    // } catch (Exception $e) {
        // return ($e->getMessage());
    // }

}
