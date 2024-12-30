<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\StudentFee;
use App\Models\AcademicYear;
use App\Mail\NotificationMail;
use App\Models\Student;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NotifyCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        info("Cron Job running at " . now());

        $current_date = now();
        $previous_month = $current_date->subMonth()->format('m');
        $get_active_year = AcademicYear::where('is_active', true)->first();

        $unpaid_fees = StudentFee::where('academic_year_id', $get_active_year->id)
                                ->where('month_number', $previous_month)
                                ->where('is_paid', false)
                                ->get();

        $parent_emails = []; 
        $student_data = null;

        foreach ($unpaid_fees as $fee) {
            $student = Student::where('id', $fee->student_id)->first();
            
            if (!$student) {
                continue;
            }

            $parent_accounts = User::where('identity_no', $student->identity_no)
                                ->whereNotNull('email')
                                ->pluck('email')
                                ->toArray();
            
            $parent_emails = array_merge($parent_emails, $parent_accounts);
            $student_data = $student; // Simpan data student terakhir
        }

        $parent_emails = array_unique(array_filter($parent_emails));

        if (empty($parent_emails)) {
            info("No parent emails found for unpaid fees notification");
            return;
        }

        try {
            Mail::to($parent_emails)->send(new NotificationMail($student_data));
            info("Successfully sent email notifications to " . count($parent_emails) . " parent accounts");
        } catch (\Exception $e) {
            Log::error("Email gagal dikirim: " . $e->getMessage());
        }
    }

}
