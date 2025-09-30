<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthFlowTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        // تأكد من أن المستخدم تم إضافته في قاعدة البيانات
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    }
    /** @test */
    public function user_can_login()
    {
        // التأكد من أن المصنع موجود ومكتمل
        $user = User::factory()->create([
            'password' => bcrypt('secret123'),
        ]);

        // تسجيل الدخول
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'secret123',
        ]);

        // التأكد من أن المستخدم تم التوثيق بنجاح
        $this->assertAuthenticatedAs($user);
    }
    /** @test */
    public function user_can_logout()
    {
        // التأكد من أن المستخدم يتم إنشاؤه بشكل صحيح
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
        ]);

        // التأكد من أن المتغير هو مستخدم واحد وليس مجموعة
        $this->assertInstanceOf(\Illuminate\Contracts\Auth\Authenticatable::class, $user);

        // محاكاة تسجيل الدخول
        $this->actingAs($user, 'web')->post('/logout');

        // التأكد من أن المستخدم تم تسجيل خروجه بنجاح
        $this->assertGuest();
    }

    /** @test */
    public function user_can_request_password_reset_link()
    {
        Notification::fake(); // منع إرسال الإشعارات الفعلية

        // التأكد من إنشاء مستخدم واحد
        $user = User::factory()->create();

        // إرسال طلب إعادة تعيين كلمة المرور
        $response = $this->post('/forgot-password', ['email' => $user->email]);

        // التأكد من أنه تم إرسال إشعار إعادة تعيين كلمة المرور
        Notification::assertSentTo($user, \Illuminate\Auth\Notifications\ResetPassword::class);
    }
    /** @test */
    public function user_can_reset_password()
    {
        Notification::fake(); // منع إرسال الإشعارات الفعلية

        $user = User::factory()->create();

        // إرسال طلب إعادة تعيين كلمة المرور
        $this->post('/forgot-password', ['email' => $user->email]);

        Notification::assertSentTo($user, \Illuminate\Auth\Notifications\ResetPassword::class, function ($notification) use ($user) {
            // التحقق من إمكانية إعادة تعيين كلمة المرور باستخدام التوكن المرسل
            $response = $this->post('/reset-password', [
                'token' => $notification->token,
                'email' => $user->email,
                'password' => 'newpassword',
                'password_confirmation' => 'newpassword',
            ]);

            // التأكد من أن كلمة المرور قد تم تحديثها بنجاح
            return Hash::check('newpassword', $user->fresh()->password);
        });
    }

    /** @test */
    public function google_auth_redirects_properly()
    {
        // التأكد من أن التوجيه يعمل بشكل صحيح
        $response = $this->get('/auth/google');
        $response->assertRedirect(); // التحقق من أنه تم التوجيه
    }

    /** @test */
    public function google_auth_callback_creates_or_logs_in_user()
    {
        // هنا تحتاج إلى إعداد Mocking للمكتبة Socialite (لتكون قادراً على محاكاة عملية الدخول عبر Google).
        // من الأفضل أن تستخدم مكتبة مثل Mockery أو PHPUnitMocks للمحاكاة.

        $this->assertTrue(true); // هذه فقط كمثال مؤقت
    }
}
