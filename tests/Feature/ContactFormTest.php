<?php 
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use App\Mail\ContactMail;
use App\Mail\ContactMailuser;

class ContactFormTest extends TestCase
{
    /** @test */
    public function contact_form_sends_emails_to_admin_and_user()
    {
        Mail::fake();

        $formData = [
            'name' => 'Test User',
            'email' => 'adlybedo@gmail.com',
            'message' => 'Test message content.',
            'phone' => '0123456789'
        ];

        $response = $this->post('/contactus', $formData);

        $response->assertRedirect(); // Redirect back
        $response->assertSessionHas('message', 'Email sent successfully!');

        // Assert both mails are sent
        Mail::assertSent(ContactMail::class, function ($mail) use ($formData) {
            return $mail->hasTo('bedoadly12@gmail.com') &&
                   $mail->name === $formData['name'] &&
                   $mail->email === $formData['email'];
        });

        Mail::assertSent(ContactMailuser::class, function ($mail) use ($formData) {
            return $mail->hasTo($formData['email']) &&
                   $mail->name === $formData['name'];
        });
    }

    /** @test */
    public function contact_form_requires_name_email_and_message()
    {
        $response = $this->post('/contactus', []); // Empty request

        $response->assertSessionHasErrors(['name', 'email', 'message']);
    }
}
