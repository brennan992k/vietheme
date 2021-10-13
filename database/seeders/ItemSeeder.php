<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\User;
use App\Models\ItemImage;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker::create();
		$preview = array('public/uploads/product/thumbnail/' . 'thumbnail-' . $faker->numberBetween(1, 7) . '.' . 'png', 'public/uploads/product/thumbnail/' . 'thumbnail-' . $faker->numberBetween(1, 7) . '.' . 'png', 'public/uploads/product/thumbnail/' . 'thumbnail-' . $faker->numberBetween(1, 7) . '.' . 'png');
		$screen_shots = array('public/uploads/product/thumbnail/' . 'thumbnail-' . $faker->numberBetween(1, 7) . '.' . 'png', 'public/uploads/product/thumbnail/' . 'thumbnail-' . $faker->numberBetween(1, 7) . '.' . 'png', 'public/uploads/product/thumbnail/' . 'thumbnail-' . $faker->numberBetween(1, 7) . '.' . 'png');
		$textD = '<p>Reliability is the key factor when it comes to running a&nbsp;<strong>Digital Market Place</strong>. Any lag or disturbance can affect your reputation. And we completely understand this responsibility from our 20 years+ of experience in working in this field. We know every nitty-gritty detail of this respected industry.</p>

<p>With our experience and state-of-the-art interface designs, we have created&nbsp;<strong>INFIX in Digital Market Place</strong>&nbsp;which is extremely reliable, intuitive, and easy to use. It can cater to all your needs of managing school, college, university and any other educational institution eliminating the tedious manual processes.</p>

<p>With a framework built this solid and reliable, you can never go wrong. Whenever you face any difficulty, our friendliest support team will be with you at every step to guide the process. Once it is set and running, you can stop worrying about the system and focus on the other more important things of your organization. The beauty of automation will be at your fingertips.</p>

<h3>Why Choose Us</h3>

<p>Right from the moment of your purchase,</p>

<ul>
	<li>You will be guided by our Comprehensive Documentation guide to getting the process up and running.</li>
	<li>You will get INFIX team&rsquo;s award-winning after-sale service. Your every issue (even the tiniest technical bits) is equally significant for us as we are relentlessly working to make this platform better every day.</li>
	<li>With this a platform this solid and the after-sale service that comes along with it, you have nothing to lose. We provide value for every penny we take.</li>
</ul>

<h3>What Features Have INFIX that Different From Others in Market?</h3>

<p><strong>Color, Design, Code &amp; Customization:</strong>&nbsp;With due respect to other Digital Market Place providers in the market, we have noticed that most of them have put little emphasis on the color palettes and front-end design of the system. So we put some extra care in it because of the look matters for the people who will be using them.</p>

<p>We pinpointed some areas which cause generally cause trouble during customizing these systems. We tried to make the process as easy as possible.</p>

<p><strong>UI &amp; UX Ready:</strong>&nbsp;Design happens to be your silent ambassador. With the end level users in mind, this platform has been designed with a super intuitive and minimalistic approach. Its user-friendliness is its gorgeousness.</p>

<p><strong>Documentation:&nbsp;</strong>The documentation guide is pretty comprehensive and divided into palatable parts. From beginner to advanced users, this documentation guide is generally enough to get the system up and running. We are continuously updating it to cover all your probable</p>

<p>&nbsp;</p>

<h2><strong>How INFIX Works:</strong></h2>

<p>However, If this video amazes you or generate a lot of question to you then we recommended please check our Pre-purchase FAQ&rsquo;s section in bellow otherwise comments section is always open.</p>

<h2><strong>INFIX Features Module:</strong></h2>

<p><strong>ADMIN SECTION:</strong></p>

<ul>
	<li>Admission Query</li>
	<li>Visitor Book</li>
	<li>Phone Call Log</li>
	<li>Postal Receive</li>
	<li>Postal Dispatch</li>
	<li>Complain</li>
	<li>Admin Setup</li>
	<li>Setup Front Office</li>
	<li>Managing User accounts (teacher, student, parent)</li>
	<li>Managing classes, subjects</li>
	<li>Managing class routine</li>
	<li>Managing exam, grades</li>
	<li>Managing exam marks</li>
	<li>Sending exam marks via sms</li>
	<li>Managing Students Attendance</li>
	<li>Student Certificate</li>
	<li>Generate Certificate</li>
	<li>Student Id Card</li>
	<li>Generate Id Card</li>
	<li>Managing accounting, income &amp; expenses</li>
	<li>Student Admission</li>
	<li>Student Details</li>
	<li>Student Promote</li>
	<li>Managing School events</li>
	<li>Student Category</li>
	<li>Student Group</li>
	<li>Desabled Student</li>
	<li>Managing library, dormitory, transport</li>
	<li>Messaging between other users</li>
	<li>Managing system settings (general, massaging , language)</li>
	<li>Dynamic Role Permission</li>
</ul>

<p><strong>TEACHER PANEL FEATURES:</strong></p>

<ul>
	<li>Add Homework</li>
	<li>Evaluation Report</li>
	<li>Upload Content</li>
	<li>Assignments</li>
	<li>Study Material</li>
	<li>Syllabus</li>
	<li>Other Downloads</li>
	<li>Teacher</li>
	<li>Managing students</li>
	<li>Managing exam marks</li>
	<li>Managing attendance</li>
</ul>

<p><strong>PARENTS PANEL FEATURES:</strong></p>

<ul>
	<li>Get children marks</li>
	<li>Get children payment invoices</li>
	<li>Get children class routine</li>
	<li>Messaging with teachers</li>
	<li>Childs attendance tracking</li>
</ul>

<p><strong>STUDENT PANEL FEATURES:</strong></p>

<ul>
	<li>Get class routine</li>
	<li>Get exam marks</li>
	<li>Get attendance status</li>
	<li>Get study materials / files from teacher</li>
	<li>Get payment invoices, pay online</li>
	<li>Communicate with teacher</li>
	<li>Online Exam</li>
</ul>

<p><strong>FEES COLLECTION:</strong></p>

<ul>
	<li>Fees payment</li>
	<li>Collect Fees</li>
	<li>Search fees Payment</li>
	<li>Search fees due</li>
	<li>Fees Master</li>
	<li>Fees Group</li>
	<li>Fees type</li>
	<li>Fees statement</li>
	<li>Reports</li>
	<li>Invoice</li>
	<li>Fees carry Forward</li>
	<li>Paid/due fees statement etc</li>
</ul>

<p><strong>ACCOUNTS:</strong></p>

<ul>
	<li>Account Dashboard</li>
	<li>Profit</li>
	<li>Income</li>
	<li>Expense</li>
	<li>Search</li>
	<li>Account List</li>
	<li>Payment Method</li>
	<li>Bank Account</li>
	<li>Payment History</li>
</ul>

<p><strong>HUMAN RESOURCE:</strong></p>

<ul>
	<li>Staff Directory</li>
	<li>Staff Attendence</li>
	<li>Staff Attendence Report</li>
	<li>Payroll</li>
	<li>Payroll Report</li>
</ul>

<p><strong>EXAMINATION:</strong></p>

<ul>
	<li>Add Exam</li>
	<li>Exam</li>
	<li>Add Exam Type</li>
	<li>Exam Schedule</li>
	<li>Seat plan</li>
	<li>Exam routine</li>
	<li>Marks Register</li>
	<li>Exam Attendence</li>
	<li>Marks Grade</li>
	<li>Send Marks by SMS</li>
	<li>Question Group</li>
	<li>Question Bank</li>
	<li>Online Exam</li>
	<li>Date &amp; time organization</li>
	<li>Schedule notice</li>
	<li>Instruction</li>
	<li>Mark sheet &amp; Report</li>
</ul>

<p><strong>ACADEMICS:</strong></p>

<ul>
	<li>Dashboard</li>
	<li>Class Routine</li>
	<li>View Class Routine (Teacher)</li>
	<li>Assign Subject</li>
	<li>Assign Class Teacher</li>
	<li>Subjects</li>
	<li>Class</li>
	<li>Sections</li>
	<li>Class Room</li>
	<li>CL/EX Time Setup</li>
	<li>Subjective assign</li>
</ul>

<p><strong>COMMUNICATE:</strong></p>

<ul>
	<li>Notice Board</li>
	<li>Send Massage</li>
	<li>Send Email/Sms</li>
	<li>Email/Sms</li>
	<li>Event notice</li>
	<li>Event Logs</li>
	<li>Holiday notice</li>
</ul>

<p><strong>LIBRARY:</strong></p>

<ul>
	<li>Add Book Book List</li>
	<li>Add Member</li>
	<li>Member listing &amp; manage</li>
	<li>Book category/list</li>
	<li>Issue/Return Book</li>
	<li>All Issued Book</li>
	<li>Card issuing</li>
</ul>

<p><strong>INVENTORY:</strong></p>

<ul>
	<li>Item Category</li>
	<li>Item List</li>
	<li>Item Store</li>
	<li>Supplier</li>
	<li>Item Receive</li>
	<li>Item Receive List</li>
	<li>Item Sell</li>
	<li>Item Issue</li>
</ul>

<p><strong>HOMEWORK:</strong></p>

<ul>
	<li>Add Home Work</li>
	<li>Home Work List</li>
	<li>Home Work Evaluation Report</li>
</ul>

<p><strong>TRANSPORT:</strong></p>

<ul>
	<li>Routes</li>
	<li>Vehicle</li>
	<li>Assign Vehicle</li>
	<li>Student Transport Report</li>
	<li>Schedule/Routine</li>
</ul>

<p><strong>DORMITORY:</strong></p>

<ul>
	<li>Dormitory Rooms</li>
	<li>Dormitory</li>
	<li>Room Type</li>
	<li>Rooms monitoring</li>
	<li>Student Dormitory Report</li>
</ul>

<p><strong>REPORTS:</strong></p>

<ul>
	<li>Student Report</li>
	<li>Guardian Report</li>
	<li>Student History</li>
	<li>Student Login Report</li>
	<li>Fees Statement</li>
	<li>Balance Fees Report</li>
	<li>Transjection Report</li>
	<li>Class Report</li>
	<li>Class Routine Report</li>
	<li>Exam Routine Report</li>
	<li>Teacher Class Routine</li>
	<li>Merit List Report</li>
	<li>Online Exam Report</li>
	<li>Mark Sheet Report</li>
	<li>Tabulation Sheet Report</li>
	<li>Progress Card Report</li>
	<li>Student Fine Report</li>
	<li>User Log</li>
	<li>Attendants Report (Teacher &amp; Student both) and Many More&hellip;</li>
</ul>

<p><strong>SYSTEM SETTINGS:</strong></p>

<ul>
	<li>General Settings</li>
	<li>Email Settings</li>
	<li>Payment Method Settings</li>
	<li>Role Permission</li>
	<li>Base Group</li>
	<li>Base Setup</li>
	<li>Academic year</li>
	<li>Session</li>
	<li>Holiday</li>
	<li>SMS Settings</li>
	<li>Weekend</li>
	<li>Language Settings</li>
	<li>Backup</li>
</ul>

<p><strong>FRONT CMS</strong></p>

<ul>
	<li>Available.</li>
</ul>

<h2><strong>INFIX has More:</strong></h2>

<ul>
	<li><strong>Optimized Performance</strong></li>
	<li><strong>One click update system</strong></li>
	<li><strong>Clean Code quality</strong></li>
	<li><strong>Installation wizard</strong></li>
	<li><strong>Multi Lingual</strong></li>
	<li><strong>Full Responsive</strong></li>
	<li><strong>RTL &ndash; Now Available</strong></li>
	<li><strong>E-mail notification with templates</strong></li>
	<li><strong>Supports SMS notification</strong></li>
	<li><strong>Printable Reports</strong></li>
	<li><strong>Powerful permission editor</strong></li>
	<li><strong>Flexible fee structure</strong></li>
	<li><strong>Details students &amp; stuff Profile</strong></li>
	<li><strong>Student attended</strong></li>
	<li><strong>Unmatched transport module</strong></li>
	<li><strong>Complete digital library system</strong></li>
</ul>

<h2><strong>Common Features:</strong></h2>

<ul>
	<li>Added Menus</li>
	<li>Added Media Manager</li>
	<li>Added Pages</li>
	<li>Added Event</li>
	<li>Added Gallery</li>
	<li>Added News</li>
	<li>Added Banner Images</li>
	<li>Added Human Resource with Payroll module</li>
	<li>Added Staff Directory</li>
	<li>Added enable/disable staff</li>
	<li>Added Staff Attendance</li>
	<li>Added Staff Attendance Report</li>
	<li>Added Payroll</li>
	<li>Added Payroll Report</li>
	<li>Added Approve Leave Request</li>
	<li>Added Apply Leave</li>
	<li>Added Leave Type</li>
	<li>Added Department</li>
	<li>Added Designation</li>
	<li>Added Front Office with Admission Enquiry module</li>
	<li>Added Admission Enquiry with Status and Follow Up</li>
	<li>Added Visitor Book</li>
	<li>Added Phone Call Log</li>
	<li>Added Postal Dispatch</li>
	<li>Added Postal Receive</li>
	<li>Added Complain</li>
	<li>Added Setup Front Office</li>
	<li>Added ACL based Roles and Permission module</li>
	<li>Added Roles</li>
	<li>Added Assign Permissions on Roles</li>
	<li>Added enable/disable modules</li>
	<li>Added Certificate and ID Card Print module</li>
	<li>Added Student Certificate</li>
	<li>Added Generate Certificate</li>
	<li>Added Student ID Card</li>
	<li>Added Generate ID Card</li>
	<li>Added Homework module</li>
	<li>Added Homework</li>
	<li>Added Homework Evaluation Report</li>
	<li>Added Calendar with To Do List module</li>
	<li>Added Calendar Event</li>
	<li>Added Task for To DO List</li>
	<li>Added File based Languages</li>
	<li>Added class-section and same role upload content in Download Center</li>
	<li>Added Student Timeline</li>
	<li>Added login with last logout page</li>
	<li>Added character count in Email/SMS send message box</li>
	<li>Added sibling feature in student edit</li>
	<li>Added Fees Carry Forward to next session</li>
	<li>Added Auto Backup using Cron</li>
	<li>Added new navigation panel for students in same class</li>
	<li>Added % in student attendance report</li>
	<li>Added UTF-8 support for csv file in student import</li>
	<li>Added new fields in student import</li>
	<li>Added enable/disable student</li>
	<li>Added online payment in student panel</li>
	<li>Added Assign Class Teacher</li>
	<li>Added Teacher Restricted Mode</li>
	<li>Added Student History</li>
	<li>Added Guardian Report</li>
	<li>Added Student Transport Report</li>
	<li>Added Student Hostel Report</li>
	<li>Added Student House, Blood Group, Height, Weight, As On Date, Father, Mother, Guardian photo in student profile</li>
	<li>Added hostel allotment in student admission</li>
	<li>Added required filed red * mark in forms</li>
	<li>Added sorting in student attendance page</li>
	<li>Added Download Center in Parent Panel</li>
</ul>

<h2><strong>INFIX- Ultimate Education ERP Pre Sale FAQ&rsquo;s:</strong></h2>

<p>There are we collecting few common questions about this ERP Software.</p>

<p>We are pretty sure it will cover 80% questions answer for your queries. Anyways, if we miss something please don&rsquo;t forget to comments. Our support team will help you by answering your specific questions. Again, we are looking forward to your suggestions and feedbacks.</p>

<h3><strong>Faq&rsquo;s (Questions &amp; Answer)</strong></h3>

<p><strong>Q. Can I use infix for my computer coaching institute?</strong></p>

<p>A. Yes, We think its possible to use for your coaching institute and academy related organization.</p>

<p><strong>Q. Remove the branding is it possible?</strong></p>

<p>A. Yes it&rsquo;s possible, You can change what you want.</p>

<p><strong>Q. Can I Track my Child&rsquo;s Attendance?</strong></p>

<p>A. Yes, of course, You can see child attendance status from Parents dashboard</p>

<p><strong>Q. Does it have a Promotion offer now?</strong></p>

<p>A. Yes, Already we have a promotional offer.</p>

<p><strong>Q. Have any Identity card printing feature?</strong></p>

<p>A. Yes, Our ERP system can generate instant printable id card.</p>

<p><strong>Q. Any option to Sending SMS for late attendance / fees payment / homework / events or other activities?</strong></p>

<p>A. Yes, Option available. )</p>

<p><strong>Q. Have any Fingerprints attendance system on this management software?</strong></p>

<p>A. No (But, we are working on it.)</p>

<p><strong>Q. Push notification added?</strong></p>

<p>A. Yes, our push notification system can informs some important info instantly.</p>

<p><strong>Q. Is it Multi-School?</strong></p>

<p>A. No. It&rsquo;s single. (If anyone need, should need to buy another license)</p>

<p><strong>Q. I want the option of transfer certificate. If any student wants to leave the school, admin should be able to generate a transfer certificate. Is it possible?</strong></p>

<p>A. Yes, it&rsquo;s available.</p>

<p><strong>Q. Can you develop customization as required?</strong></p>

<p>A. Yes, we have experienced developer; who can provide your required based system.</p>

<p><strong>Q. Is it generating report card?</strong></p>

<p>A. Yes, you can generator report card anytime</p>

<p><strong>Q. New student registration system?</strong></p>

<p>A. Yes, we have an auto pre-built registration form for student registration.</p>

<p><strong>Q. Can we use it with localhost?</strong></p>

<p>A. Yes, our software system is familiar with localhost server.</p>

<p><strong>Q. Can this software calculate semester-based CGPA/GPA?</strong></p>

<p>A. Yes, of course. We already added the result calculated formula.</p>

<p><strong>Q. Does it have Partial Fee Payment system?</strong></p>

<p>A. Yes, its available.</p>

<p><strong>Q. Is this compatible with PHP 7.3?</strong></p>

<p>A. Yes it already compatible with PHP 7.3. For use our ERP software User system required to at least PHP 7.1.3 or above version.</p>

<p><strong>Q. Does it support RTL or Multi-language?</strong></p>

<p>A. Yes.</p>

<p><strong>Q. Can I take online exams from this application?</strong></p>

<p>A. Yes, You can manage any online examination by our organized management system easily.</p>

<p><strong>Q. Is this build by core PHP or any other PHP framework?</strong></p>

<p>A. We use mostly smooth and secure Laravel framework for making our software.</p>

<p><strong>Q. When is support for Android App released ?</strong></p>

<p>A. Within a few months</p>

<p><strong>Q. Is Paystack payment system enabled here?</strong></p>

<p>A. Yes, Paystack system enable.</p>

<ul>
</ul>

<h3>Infix System Requirements</h3>

<p>If you are not using Homestead, you will need to make sure your server meets the following requirements:</p>

<ul>
	<li>PHP &gt;= 7.1. 3</li>
	<li>OpenSSL PHP Extension</li>
	<li>PDO PHP Extension</li>
	<li>Mbstring PHP Extension</li>
	<li>Tokenizer PHP Extension</li>
	<li>XML PHP Extension</li>
	<li>Ctype PHP Extension</li>
	<li>JSON PHP Extension</li>
	<li>BCMath PHP Extension</li>
</ul>

<p>* In most hosting accounts, these extensions are enabled by default. But you should check with your hosting provider.</p>

<p>After installation Infix School to work properly, you must make a few directories/files writable, permission is 777.&nbsp;<strong>Below are a list of directories/files you should ensure that have to write permissions.</strong></p>

<ul>
	<li>installation_dir/bootstrap</li>
	<li>installation_dir/resources</li>
	<li>installation_dir/storage</li>
	<li>installation_dir/public</li>
</ul>

<h3>Important notice:</h3>

<ul>
	<li>We don&rsquo;t offer free support (Time support can up to 2 days)</li>
	<li>We don&rsquo;t offer refund (If item has been Dowloaded or Mistake)</li>
	<li>We don&rsquo;t support install and custom script free</li>
	<li>Read all the product information before you decide to buy it</li>
	<li>One purchase can use maximum one school only</li>
	<li>We have demo to check all the point, after purchase cannot accept the refund this feature not available. something like that.</li>
</ul>

<h2>Support Facility:</h2>

<p>Please send us your product presale query, after sales developer support request, customization project and any other queries to our dedicated support:&nbsp;<a href="https://ticket.spondonit.com/index.php">https://ticket.spondonit.com/index.php</a></p>

<h3>Required any customization feel free to mail us with your complete requirement to&nbsp;<a href="mailto:support@spondonit.com">support@spondonit.com</a></h3>

<h3>WE STRONGLY RECOMMEND TO USE V5 FRESH COPY INSTEAD OF UPDATING, DUE TO MAJOR CHANGES</h3>

<h2><strong>Update/ Change-Log</strong></h2>

<p>v5 -Major Release (7 Aug 2020)</p>

<p>v5.2 (29 Oct 2020)</p>

<pre>
Fixed   : 100 Plus minor bug fixed
Update  : Code optimized</pre>

<h2><strong>How INFIX Works:</strong></h2>

<p>However, If this video amazes you or generate a lot of question to you then we recommended please check our Pre-purchase FAQ&rsquo;s section in bellow otherwise comments section is always open.</p>

<h2><strong>INFIX Features Module:</strong></h2>

<p><strong>ADMIN SECTION:</strong></p>

<ul>
	<li>Admission Query</li>
	<li>Visitor Book</li>
	<li>Phone Call Log</li>
	<li>Postal Receive</li>
	<li>Postal Dispatch</li>
	<li>Complain</li>
	<li>Admin Setup</li>
	<li>Setup Front Office</li>
	<li>Managing User accounts (teacher, student, parent)</li>
	<li>Managing classes, subjects</li>
	<li>Managing class routine</li>
	<li>Managing exam, grades</li>
	<li>Managing exam marks</li>
	<li>Sending exam marks via sms</li>
	<li>Managing Students Attendance</li>
	<li>Student Certificate</li>
	<li>Generate Certificate</li>
	<li>Student Id Card</li>
	<li>Generate Id Card</li>
	<li>Managing accounting, income &amp; expenses</li>
	<li>Student Admission</li>
	<li>Student Details</li>
	<li>Student Promote</li>
	<li>Managing School events</li>
	<li>Student Category</li>
	<li>Student Group</li>
	<li>Desabled Student</li>
	<li>Managing library, dormitory, transport</li>
	<li>Messaging between other users</li>
	<li>Managing system settings (general, massaging , language)</li>
	<li>Dynamic Role Permission</li>
</ul>

<p><strong>TEACHER PANEL FEATURES:</strong></p>

<ul>
	<li>Add Homework</li>
	<li>Evaluation Report</li>
	<li>Upload Content</li>
	<li>Assignments</li>
	<li>Study Material</li>
	<li>Syllabus</li>
	<li>Other Downloads</li>
	<li>Teacher</li>
	<li>Managing students</li>
	<li>Managing exam marks</li>
	<li>Managing attendance</li>
</ul>

<p><strong>PARENTS PANEL FEATURES:</strong></p>

<ul>
	<li>Get children marks</li>
	<li>Get children payment invoices</li>
	<li>Get children class routine</li>
	<li>Messaging with teachers</li>
	<li>Childs attendance tracking</li>
</ul>

<p><strong>STUDENT PANEL FEATURES:</strong></p>

<ul>
	<li>Get class routine</li>
	<li>Get exam marks</li>
	<li>Get attendance status</li>
	<li>Get study materials / files from teacher</li>
	<li>Get payment invoices, pay online</li>
	<li>Communicate with teacher</li>
	<li>Online Exam</li>
</ul>

<p><strong>FEES COLLECTION:</strong></p>

<ul>
	<li>Fees payment</li>
	<li>Collect Fees</li>
	<li>Search fees Payment</li>
	<li>Search fees due</li>
	<li>Fees Master</li>
	<li>Fees Group</li>
	<li>Fees type</li>
	<li>Fees statement</li>
	<li>Reports</li>
	<li>Invoice</li>
	<li>Fees carry Forward</li>
	<li>Paid/due fees statement etc</li>
</ul>

<p><strong>ACCOUNTS:</strong></p>

<ul>
	<li>Account Dashboard</li>
	<li>Profit</li>
	<li>Income</li>
	<li>Expense</li>
	<li>Search</li>
	<li>Account List</li>
	<li>Payment Method</li>
	<li>Bank Account</li>
	<li>Payment History</li>
</ul>

<p><strong>HUMAN RESOURCE:</strong></p>

<ul>
	<li>Staff Directory</li>
	<li>Staff Attendence</li>
	<li>Staff Attendence Report</li>
	<li>Payroll</li>
	<li>Payroll Report</li>
</ul>

<p><strong>EXAMINATION:</strong></p>

<ul>
	<li>Add Exam</li>
	<li>Exam</li>
	<li>Add Exam Type</li>
	<li>Exam Schedule</li>
	<li>Seat plan</li>
	<li>Exam routine</li>
	<li>Marks Register</li>
	<li>Exam Attendence</li>
	<li>Marks Grade</li>
	<li>Send Marks by SMS</li>
	<li>Question Group</li>
	<li>Question Bank</li>
	<li>Online Exam</li>
	<li>Date &amp; time organization</li>
	<li>Schedule notice</li>
	<li>Instruction</li>
	<li>Mark sheet &amp; Report</li>
</ul>

<p><strong>ACADEMICS:</strong></p>

<ul>
	<li>Dashboard</li>
	<li>Class Routine</li>
	<li>View Class Routine (Teacher)</li>
	<li>Assign Subject</li>
	<li>Assign Class Teacher</li>
	<li>Subjects</li>
	<li>Class</li>
	<li>Sections</li>
	<li>Class Room</li>
	<li>CL/EX Time Setup</li>
	<li>Subjective assign</li>
</ul>

<p><strong>COMMUNICATE:</strong></p>

<ul>
	<li>Notice Board</li>
	<li>Send Massage</li>
	<li>Send Email/Sms</li>
	<li>Email/Sms</li>
	<li>Event notice</li>
	<li>Event Logs</li>
	<li>Holiday notice</li>
</ul>

<p><strong>LIBRARY:</strong></p>

<ul>
	<li>Add Book Book List</li>
	<li>Add Member</li>
	<li>Member listing &amp; manage</li>
	<li>Book category/list</li>
	<li>Issue/Return Book</li>
	<li>All Issued Book</li>
	<li>Card issuing</li>
</ul>

<p><strong>INVENTORY:</strong></p>

<ul>
	<li>Item Category</li>
	<li>Item List</li>
	<li>Item Store</li>
	<li>Supplier</li>
	<li>Item Receive</li>
	<li>Item Receive List</li>
	<li>Item Sell</li>
	<li>Item Issue</li>
</ul>

<p><strong>HOMEWORK:</strong></p>

<ul>
	<li>Add Home Work</li>
	<li>Home Work List</li>
	<li>Home Work Evaluation Report</li>
</ul>

<p><strong>TRANSPORT:</strong></p>

<ul>
	<li>Routes</li>
	<li>Vehicle</li>
	<li>Assign Vehicle</li>
	<li>Student Transport Report</li>
	<li>Schedule/Routine</li>
</ul>

<p><strong>DORMITORY:</strong></p>

<ul>
	<li>Dormitory Rooms</li>
	<li>Dormitory</li>
	<li>Room Type</li>
	<li>Rooms monitoring</li>
	<li>Student Dormitory Report</li>
</ul>

<p><strong>REPORTS:</strong></p>

<ul>
	<li>Student Report</li>
	<li>Guardian Report</li>
	<li>Student History</li>
	<li>Student Login Report</li>
	<li>Fees Statement</li>
	<li>Balance Fees Report</li>
	<li>Transjection Report</li>
	<li>Class Report</li>
	<li>Class Routine Report</li>
	<li>Exam Routine Report</li>
	<li>Teacher Class Routine</li>
	<li>Merit List Report</li>
	<li>Online Exam Report</li>
	<li>Mark Sheet Report</li>
	<li>Tabulation Sheet Report</li>
	<li>Progress Card Report</li>
	<li>Student Fine Report</li>
	<li>User Log</li>
	<li>Attendants Report (Teacher &amp; Student both) and Many More&hellip;</li>
</ul>

<p><strong>SYSTEM SETTINGS:</strong></p>

<ul>
	<li>General Settings</li>
	<li>Email Settings</li>
	<li>Payment Method Settings</li>
	<li>Role Permission</li>
	<li>Base Group</li>
	<li>Base Setup</li>
	<li>Academic year</li>
	<li>Session</li>
	<li>Holiday</li>
	<li>SMS Settings</li>
	<li>Weekend</li>
	<li>Language Settings</li>
	<li>Backup</li>
</ul>

<p><strong>FRONT CMS</strong></p>

<ul>
	<li>Available.</li>
</ul>

<h2><strong>INFIX has More:</strong></h2>

<ul>
	<li><strong>Optimized Performance</strong></li>
	<li><strong>One click update system</strong></li>
	<li><strong>Clean Code quality</strong></li>
	<li><strong>Installation wizard</strong></li>
	<li><strong>Multi Lingual</strong></li>
	<li><strong>Full Responsive</strong></li>
	<li><strong>RTL &ndash; Now Available</strong></li>
	<li><strong>E-mail notification with templates</strong></li>
	<li><strong>Supports SMS notification</strong></li>
	<li><strong>Printable Reports</strong></li>
	<li><strong>Powerful permission editor</strong></li>
	<li><strong>Flexible fee structure</strong></li>
	<li><strong>Details students &amp; stuff Profile</strong></li>
	<li><strong>Student attended</strong></li>
	<li><strong>Unmatched transport module</strong></li>
	<li><strong>Complete digital library system</strong></li>
</ul>

<h2><strong>Common Features:</strong></h2>

<ul>
	<li>Added Menus</li>
	<li>Added Media Manager</li>
	<li>Added Pages</li>
	<li>Added Event</li>
	<li>Added Gallery</li>
	<li>Added News</li>
	<li>Added Banner Images</li>
	<li>Added Human Resource with Payroll module</li>
	<li>Added Staff Directory</li>
	<li>Added enable/disable staff</li>
	<li>Added Staff Attendance</li>
	<li>Added Staff Attendance Report</li>
	<li>Added Payroll</li>
	<li>Added Payroll Report</li>
	<li>Added Approve Leave Request</li>
	<li>Added Apply Leave</li>
	<li>Added Leave Type</li>
	<li>Added Department</li>
	<li>Added Designation</li>
	<li>Added Front Office with Admission Enquiry module</li>
	<li>Added Admission Enquiry with Status and Follow Up</li>
	<li>Added Visitor Book</li>
	<li>Added Phone Call Log</li>
	<li>Added Postal Dispatch</li>
	<li>Added Postal Receive</li>
	<li>Added Complain</li>
	<li>Added Setup Front Office</li>
	<li>Added ACL based Roles and Permission module</li>
	<li>Added Roles</li>
	<li>Added Assign Permissions on Roles</li>
	<li>Added enable/disable modules</li>
	<li>Added Certificate and ID Card Print module</li>
	<li>Added Student Certificate</li>
	<li>Added Generate Certificate</li>
	<li>Added Student ID Card</li>
	<li>Added Generate ID Card</li>
	<li>Added Homework module</li>
	<li>Added Homework</li>
	<li>Added Homework Evaluation Report</li>
	<li>Added Calendar with To Do List module</li>
	<li>Added Calendar Event</li>
	<li>Added Task for To DO List</li>
	<li>Added File based Languages</li>
	<li>Added class-section and same role upload content in Download Center</li>
	<li>Added Student Timeline</li>
	<li>Added login with last logout page</li>
	<li>Added character count in Email/SMS send message box</li>
	<li>Added sibling feature in student edit</li>
	<li>Added Fees Carry Forward to next session</li>
	<li>Added Auto Backup using Cron</li>
	<li>Added new navigation panel for students in same class</li>
	<li>Added % in student attendance report</li>
	<li>Added UTF-8 support for csv file in student import</li>
	<li>Added new fields in student import</li>
	<li>Added enable/disable student</li>
	<li>Added online payment in student panel</li>
	<li>Added Assign Class Teacher</li>
	<li>Added Teacher Restricted Mode</li>
	<li>Added Student History</li>
	<li>Added Guardian Report</li>
	<li>Added Student Transport Report</li>
	<li>Added Student Hostel Report</li>
	<li>Added Student House, Blood Group, Height, Weight, As On Date, Father, Mother, Guardian photo in student profile</li>
	<li>Added hostel allotment in student admission</li>
	<li>Added required filed red * mark in forms</li>
	<li>Added sorting in student attendance page</li>
	<li>Added Download Center in Parent Panel</li>
</ul>

<h2><strong>INFIX- Ultimate Education ERP Pre Sale FAQ&rsquo;s:</strong></h2>

<p>There are we collecting few common questions about this ERP Software.</p>

<p>We are pretty sure it will cover 80% questions answer for your queries. Anyways, if we miss something please don&rsquo;t forget to comments. Our support team will help you by answering your specific questions. Again, we are looking forward to your suggestions and feedbacks.</p>

<h3><strong>Faq&rsquo;s (Questions &amp; Answer)</strong></h3>

<p><strong>Q. Can I use infix for my computer coaching institute?</strong></p>

<p>A. Yes, We think its possible to use for your coaching institute and academy related organization.</p>

<p><strong>Q. Remove the branding is it possible?</strong></p>

<p>A. Yes it&rsquo;s possible, You can change what you want.</p>

<p><strong>Q. Can I Track my Child&rsquo;s Attendance?</strong></p>

<p>A. Yes, of course, You can see child attendance status from Parents dashboard</p>

<p><strong>Q. Does it have a Promotion offer now?</strong></p>

<p>A. Yes, Already we have a promotional offer.</p>

<p><strong>Q. Have any Identity card printing feature?</strong></p>

<p>A. Yes, Our ERP system can generate instant printable id card.</p>

<p><strong>Q. Any option to Sending SMS for late attendance / fees payment / homework / events or other activities?</strong></p>

<p>A. Yes, Option available. )</p>

<p><strong>Q. Have any Fingerprints attendance system on this management software?</strong></p>

<p>A. No (But, we are working on it.)</p>

<p><strong>Q. Push notification added?</strong></p>

<p>A. Yes, our push notification system can informs some important info instantly.</p>

<p><strong>Q. Is it Multi-School?</strong></p>

<p>A. No. It&rsquo;s single. (If anyone need, should need to buy another license)</p>

<p><strong>Q. I want the option of transfer certificate. If any student wants to leave the school, admin should be able to generate a transfer certificate. Is it possible?</strong></p>

<p>A. Yes, it&rsquo;s available.</p>

<p><strong>Q. Can you develop customization as required?</strong></p>

<p>A. Yes, we have experienced developer; who can provide your required based system.</p>

<p><strong>Q. Is it generating report card?</strong></p>

<p>A. Yes, you can generator report card anytime</p>

<p><strong>Q. New student registration system?</strong></p>

<p>A. Yes, we have an auto pre-built registration form for student registration.</p>

<p><strong>Q. Can we use it with localhost?</strong></p>

<p>A. Yes, our software system is familiar with localhost server.</p>

<p><strong>Q. Can this software calculate semester-based CGPA/GPA?</strong></p>

<p>A. Yes, of course. We already added the result calculated formula.</p>

<p><strong>Q. Does it have Partial Fee Payment system?</strong></p>

<p>A. Yes, its available.</p>

<p><strong>Q. Is this compatible with PHP 7.3?</strong></p>

<p>A. Yes it already compatible with PHP 7.3. For use our ERP software User system required to at least PHP 7.1.3 or above version.</p>

<p><strong>Q. Does it support RTL or Multi-language?</strong></p>

<p>A. Yes.</p>

<p><strong>Q. Can I take online exams from this application?</strong></p>

<p>A. Yes, You can manage any online examination by our organized management system easily.</p>

<p><strong>Q. Is this build by core PHP or any other PHP framework?</strong></p>

<p>A. We use mostly smooth and secure Laravel framework for making our software.</p>

<p><strong>Q. When is support for Android App released ?</strong></p>

<p>A. Within a few months</p>

<p><strong>Q. Is Paystack payment system enabled here?</strong></p>

<p>A. Yes, Paystack system enable.</p>

<ul>
</ul>

<h3>Infix System Requirements</h3>

<p>If you are not using Homestead, you will need to make sure your server meets the following requirements:</p>

<ul>
	<li>PHP &gt;= 7.1. 3</li>
	<li>OpenSSL PHP Extension</li>
	<li>PDO PHP Extension</li>
	<li>Mbstring PHP Extension</li>
	<li>Tokenizer PHP Extension</li>
	<li>XML PHP Extension</li>
	<li>Ctype PHP Extension</li>
	<li>JSON PHP Extension</li>
	<li>BCMath PHP Extension</li>
</ul>

<p>* In most hosting accounts, these extensions are enabled by default. But you should check with your hosting provider.</p>

<p>After installation Infix School to work properly, you must make a few directories/files writable, permission is 777.&nbsp;<strong>Below are a list of directories/files you should ensure that have to write permissions.</strong></p>

<ul>
	<li>installation_dir/bootstrap</li>
	<li>installation_dir/resources</li>
	<li>installation_dir/storage</li>
	<li>installation_dir/public</li>
</ul>

<h3>Important notice:</h3>

<ul>
	<li>We don&rsquo;t offer free support (Time support can up to 2 days)</li>
	<li>We don&rsquo;t offer refund (If item has been Dowloaded or Mistake)</li>
	<li>We don&rsquo;t support install and custom script free</li>
	<li>Read all the product information before you decide to buy it</li>
	<li>One purchase can use maximum one school only</li>
	<li>We have demo to check all the point, after purchase cannot accept the refund this feature not available. something like that.</li>
</ul>

<h2>Support Facility:</h2>

<p>Please send us your product presale query, after sales developer support request, customization project and any other queries to our dedicated support:&nbsp;<a href="https://ticket.spondonit.com/index.php">https://ticket.spondonit.com/index.php</a></p>

<h3>Required any customization feel free to mail us with your complete requirement to&nbsp;<a href="mailto:support@spondonit.com">support@spondonit.com</a></h3>

<h3>WE STRONGLY RECOMMEND TO USE V5 FRESH COPY INSTEAD OF UPDATING, DUE TO MAJOR CHANGES</h3>

<h2><strong>Update/ Change-Log</strong></h2>

<p>v5 -Major Release (7 Aug 2020)</p>

<p>v5.2 (29 Oct 2020)</p>

<pre>
Fixed   : 100 Plus minor bug fixed
Update  : Code optimized</pre>';



		$category = DB::table('item_categories')
			->join('item_sub_categories', 'item_categories.id', '=', 'item_sub_categories.item_category_id')
			->select('item_sub_categories.id as sub_category_id', 'item_sub_categories.title as sub_category_title', 'item_sub_categories.active_status as sub_category_status', 'item_categories.id as category_id', 'item_categories.title as category_title', 'item_categories.active_status as category_status')
			->where('item_sub_categories.active_status', 1)
			->where('item_categories.active_status', 1)
			->get();
		$users = User::where('role_id', 4)->where('access_status', 1)->where('status', 1)->get();
		foreach ($users as $val => $user) {
			foreach ($category as $key => $value) {
				//$count = 0;
				for ($i = 1; $i <= 10; $i++) {
					$data = new Item();
					$data->user_id = $user->id;
					$data->category_id = $value->category_id;
					$data->sub_category_id = $value->sub_category_id;
					$data->title = $faker->sentence($nbWords = 2, $variableNbWords = true);
					$data->feature1 = $faker->sentence;
					$data->feature2 = $faker->sentence;
					$data->description = $textD;
					// $data->resolution = 'Yes';
					// $data->widget = 'Yes';
					$data->icon = 'public/uploads/product/thumbnail/demo/' . 'Layer-' . $i . '.' . 'png';
					$data->thumbnail = 'public/uploads/product/thumbnail/' . 'thumbnail-' . $faker->numberBetween(1, 7) . '.' . 'png';
					$data->theme_preview = 'public/uploads/product/thumbnail/' . 'thumbnail-' . $faker->numberBetween(1, 7) . '.' . 'png' . ',' . 'public/uploads/product/thumbnail/' . 'thumbnail-' . $faker->numberBetween(1, 7) . '.' . 'png';
					$data->screen_shot = 'public/uploads/product/thumbnail/' . 'thumbnail-' . $faker->numberBetween(1, 7) . '.' . 'png' . ',' . 'public/uploads/product/thumbnail/' . 'thumbnail-' . $faker->numberBetween(1, 7) . '.' . 'png';
					$data->file = 'public/uploads/product/file/zip/' . 'file-0' . '.' . 'zip';
					$data->main_file = 'public/uploads/product/main_file/zip/' . 'main_file-' . $key . '.' . 'zip';
					// $data->compatible_browsers = 1;
					// $data->compatible_with = 3;
					// $data->framework = 5;
					// $data->software_version = 7;
					// $data->columns = 2;
					// $data->layout = 'Fixed';
					$data->demo_url = 'https://spondonit.com/';
					$data->tags  = 'html,wordpress,php,blog';
					$data->Re_item = 50 + $key + $i;
					$data->Re_buyer = 12;
					$data->Reg_total = 50 + $key + $i + 12;

					$data->C_item = 60 + $key + $i;
					$data->C_buyer = 15;
					$data->C_total = 60 + $key + $i + 12;

					$data->E_item = 400 + $key + $i;
					$data->E_buyer = 12;
					$data->Ex_total = 400 + $key + $i + 12;
					$data->user_msg = $faker->text;
					$data->status = 1;
					$data->active_status = 1;
					$data->save();

					$image = new ItemImage();
					$image->item_id = $data->id;
					$image->type = 'theme_preview';
					$image->image = implode(",", $preview);
					$image->save();

					$image = new ItemImage();
					$image->item_id = $data->id;
					$image->type = 'screen_shot';
					// $image->image=implode(",",$screen_shots);
					$image->image = 'public/uploads/product/screen_shot/screenshot_0.png,public/uploads/product/screen_shot/screenshot_1.png';
					$image->save();
				}
			}
		}
	}
}
