<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Event;
use App\Mail\SignupMail;
use App\Mail\AdminNotify;
use App\Models\Procurement;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Mail\ContactSendMessage;
use App\Models\DepartmentOffice;
use App\Mail\AdminContactMessage;
use Illuminate\Support\Facades\Mail;
use App\Models\ContractorProcurement;
use App\Models\DepartmentProcurement;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
	protected $page_title = "Public Procurement Regulatory Authority GB (PPRA) | Home";

	public function index()
	{
		$selected_main_menu = "home_page";

		$this->page_title = "Public Procurement Regulatory Authority GB (PPRA) | Home";

        $procurements = DepartmentProcurement::where('status', 1)->with(['procurement', 'departmentoffice'])->orderBy('opening_date', 'desc')->limit(5)->get();
        $newss = Event::where('type', 1)->orderBy('created_at', 'desc')->limit(4)->get();
        $proc_counts = DepartmentProcurement::groupBy('procurements.id', 'procurements.name')
                            ->leftJoin('procurements', 'procurements.id', '=', 'department_procurements.procurement_id')
                            ->selectRaw('count(*) as total_procurements, procurements.name as procurement_name')
                            ->where('department_procurements.status', 1)
                            ->limit(4)
                            ->pluck('total_procurements','procurement_name');

        $procs = Procurement::with('departmentprocurements')->limit(4)->get();
        $random = [0 => 'secondary', 1 => 'warning', 2 =>  'danger', 3 => 'primary'];

		return view('home.index')
            ->with('procs', $procs)
			->with('procurements', $procurements)
			->with('newss', $newss)
			->with('proc_counts', $proc_counts)
			->with('random', $random)
            ->with('procurement_types', Procurement::all())
            ->with('departments', DepartmentOffice::all())
            ->with('gs', GeneralSetting::first())
            ->with('selected_main_menu', $selected_main_menu)
            ->with('page_title', $this->page_title);
	}

    public function services($page){

        $pages = [
            'rules_regulations' => 'Rules / Regulations',
            'tender_guidelines' => 'Tender Guidelines',
            'bidding_documents' => 'Bidding Documents',
            'tender_instructions' => 'Tender Instructions',
            'public_procurement' => 'Public Procurement Checklist',
            'standing_instructions' => 'Standing Instructions',
        ];

        $selected_main_menu = "instructions_page";
        $this->page_title = "Public Procurement Regulatory Authority GB (PPRA) | ". $pages[$page];

        return view('home.instructions')
            ->with('page', $page)
            ->with('pages', $pages)
            ->with('gs', GeneralSetting::first())
            ->with('selected_main_menu', $selected_main_menu)
            ->with('page_title', $this->page_title);
    }

    public function contact() {
        $selected_main_menu = "contact_page";

		$this->page_title = "Public Procurement Regulatory Authority GB (PPRA) | Contact";

		return view('home.contact')
            ->with('gs', GeneralSetting::first())
            ->with('selected_main_menu', $selected_main_menu)
            ->with('page_title', $this->page_title);
    }

    public function submitmessage(Request $request) {
        $validatedData = $request->validate([
            'fullname' => 'required|string|min:3|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|min:10',
            'message' => 'required|string|min:10',
        ]);

        if (class_exists(\App\Mail\ContactSendMessage::class) && class_exists(\App\Mail\AdminContactMessage::class)) {
            // Mail classes exist, so execute the code inside this block


            // Send emails
            $this->sendUserEmail($request->all());
            $this->sendAdminEmail($request->all());

            // Redirect to a success page or do something else
            return redirect('/contact')->with('success', 'You message has been sent successfully.You will be contacted soon.');
        } else {
            // Mail classes don't exist, so execute the code inside this block
            // Redirect to a failure page or do something else
            return redirect('/contact')->with('error', 'Something went wrong. Please try again later.');
        }
    }

    protected function sendUserEmail($data)
    {
        Mail::to($data['email'])->send(new ContactSendMessage($data));
    }

    protected function sendAdminEmail($data)
    {
        Mail::to(env('ADMIN_EMAIL'))->send(new AdminContactMessage($data));
    }

    public function about() {
        $selected_main_menu = "about_page";

		$this->page_title = "Public Procurement Regulatory Authority GB (PPRA) | About";

		return view('home.about')
            ->with('selected_main_menu', $selected_main_menu)
            ->with('page_title', $this->page_title);
    }

    public function news() {
        $selected_main_menu = "news_page";
        $this->page_title = "Public Procurement Regulatory Authority GB (PPRA) | News";

        // Get the latest two news items with pagination
        $news = Event::where('type', 1)->latest()->paginate(2);

        // Get IDs of the first two news items
        $excludedIds = $news->pluck('id');

        // Get related news excluding the first two news items
        $relatedNews = Event::where('type', 1)
            ->whereNotIn('id', $excludedIds)
            ->latest()
            ->take(2) // Change the number of related news items as needed
            ->get();

        return view('home.news')
            ->with('news', $news)
            ->with('relatedNews', $relatedNews)
            ->with('selected_main_menu', $selected_main_menu)
            ->with('page_title', $this->page_title);
    }

    public function getnews($id) {
        $selected_main_menu = "news_page";

        $news = Event::find($id);
        $this->page_title = "Public Procurement Regulatory Authority GB (PPRA) | ". $news->title;

        // Get related news excluding the first two news items
        $relatedNews = Event::where('type', 1)
            ->where('id', '<>', $news->id)
            ->latest()
            ->take(2) // Change the number of related news items as needed
            ->get();

        return view('home.getnews')
            ->with('news', $news)
            ->with('relatedNews', $relatedNews)
            ->with('selected_main_menu', $selected_main_menu)
            ->with('page_title', $this->page_title);
    }

    public function publications() {
        $selected_main_menu = "publications_page";

		$this->page_title = "Public Procurement Regulatory Authority GB (PPRA) | Publications";

        $publications = Event::where('type', 2)->latest()->get();

		return view('home.publications')
            ->with('publications', $publications)
            ->with('selected_main_menu', $selected_main_menu)
            ->with('page_title', $this->page_title);
    }

    public function pressclippings() {
        $selected_main_menu = "press_clippings_page";

		$this->page_title = "Public Procurement Regulatory Authority GB (PPRA) | Press Clippings";

        $pressclippings = Event::where('type', 3)->latest()->get();

		return view('home.pressclippings')
            ->with('pressclippings', $pressclippings)
            ->with('selected_main_menu', $selected_main_menu)
            ->with('page_title', $this->page_title);
    }

    public function download() {
        $selected_main_menu = "downloads_page";

		$this->page_title = "Public Procurement Regulatory Authority GB (PPRA) | Downloads";

        $downloads = Event::where('type', 0)->latest()->get();

		return view('home.downloads')
            ->with('downloads', $downloads)
            ->with('selected_main_menu', $selected_main_menu)
            ->with('page_title', $this->page_title);
    }

    public function viewall(Request $request) {
        $year = $request->input('year');
        $month = $request->input('month');
        $day = $request->input('day');
        $selected_main_menu = "search_results";
        $this->page_title = "Public Procurement Regulatory Authority GB (PPRA) | View All";

        $procurementsQuery = DepartmentProcurement::where('status', 1);

        /* if ($year) {
            $procurementsQuery->whereYear('closing_date', $year);

            if ($month) {
                $procurementsQuery->whereMonth('closing_date', $month);

                if ($day) {
                    $procurementsQuery->whereDay('closing_date', $day);
                }
            }
        } */

        $current_year = date('Y');
        $years = range($current_year, $current_year - 10);

        $months = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => "June",
            7 => "July",
            8 => "August",
            9 => "September",
            10 => "October",
            11 => 'November',
            12 => 'December'
        ];

        $days = range(1, 31);

        //dd($month, $months, array_search($month, $months));

        if ($year !== null) {
            $procurementsQuery->whereYear('closing_date', $year);
        }

        if ($month !== null) {
            $monthNumeric = array_search($month, $months);
            $procurementsQuery->whereMonth('closing_date', $monthNumeric);
        }

        if ($day !== null) {
            $procurementsQuery->whereDay('closing_date', $day);
        }


        $procurements = $procurementsQuery->paginate(10);
        $procurements->appends(['year' => $year, 'month' => $month, 'day' => $day]);

        return view('home.viewall')
            ->with('procurements', $procurements)
            ->with('month', $month)
            ->with('day', $day)
            ->with('year', $year)
            ->with('years', $years)
            ->with('months', $months)
            ->with('days', $days)
            ->with('selected_main_menu', $selected_main_menu)
            ->with('page_title', $this->page_title);
    }


    public function searchresults(Request $request) {
        $selected_main_menu = "search_results";
        $keyword = $request->input('keyword');
        $procurement_type = $request->input('procurement_type');
        $department = $request->input('department');

        $this->page_title = "Public Procurement Regulatory Authority GB (PPRA) | Search Results";

        $proc = null;
        $dept = null;

        if ($procurement_type) {
            $proc = Procurement::find($procurement_type);
        }

        if ($department) {
            $dept = DepartmentOffice::where('ddo_code', $department)->first();
        }

        $procurements = DepartmentProcurement::where('status', 1)
            ->where(function ($query) use ($keyword) {
                $query->where('title', 'like', '%' . $keyword . '%')
                    ->orWhere(function ($subquery) use ($keyword) {
                        $subquery->whereRaw("CONCAT('[TSE-', DATE_FORMAT(opening_date, '%Y%m%d'), id, ']') LIKE ?", ['%' . $keyword . '%']);
                    });
            })
            ->when($procurement_type, function ($query, $procurement_type) {
                $query->where('procurement_id', $procurement_type);
            })
            ->when($department, function ($query, $department) {
                $query->where('ddo_code', $department);
            })
            ->with(['procurement', 'departmentoffice'])
            ->orderBy('opening_date', 'desc')
            ->get();

        return view('home.searchresults')
            ->with('procurements', $procurements)
            ->with('keyword', $keyword)
            ->with('procurement_type', $proc)
            ->with('department', $dept)
            ->with('selected_main_menu', $selected_main_menu)
            ->with('page_title', $this->page_title);
    }

    public function procurements($procurement_id) {
        $selected_main_menu = "public_procurement";

		$this->page_title = "Public Procurement Regulatory Authority GB (PPRA) | Procurements";

        $dept_procurements = DepartmentProcurement::where('procurement_id', $procurement_id)->where('status', 1)->with(['procurement', 'departmentoffice', 'departmentprocurementcomments'])->get();
        $proc = Procurement::find($procurement_id);
        //dd($dept_procurements);

        return view('home.procurements')
            ->with('procurements', $dept_procurements)
            ->with('proc', $proc)
            ->with('selected_main_menu', $selected_main_menu)
            ->with('page_title', $this->page_title);
    }

    public function procurementdetails($procurement_id){
        $selected_main_menu = "procurement_detail_page";

        $dept_procurement = DepartmentProcurement::where('id', $procurement_id)->where('status', 1)->with(['procurement', 'departmentoffice', 'departmentprocurementcomments'])->first();

        $this->page_title = "Public Procurement Regulatory Authority GB (PPRA) | ". $dept_procurement->title;

		return view('home.procurementdetails')
            ->with('procurement', $dept_procurement)
            ->with('selected_main_menu', $selected_main_menu)
            ->with('page_title', $this->page_title);
    }

}
