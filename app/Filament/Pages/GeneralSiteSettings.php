<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Pages\Page;
use App\Models\GeneralSetting;
use Filament\Forms\Components\Tabs;
use Filament\Notifications\Notification;
use Illuminate\Http\Response;
//use Nuhel\FilamentCropper\Components\Cropper;

class GeneralSiteSettings extends Page
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-s-cog';

    protected static string $view = 'filament.pages.general-site-settings';

    protected static ?int $navigationSort = 10;

    public GeneralSetting $gs;

    public $meta_description;
    public $meta_keywords;
    public $meta_author;
    public $department_full_name;
    public $department_short_name;
    public $department_description;
    public $department_logo;
    public $global_phone_no;
    public $global_mobile_no;
    public $global_address;
    public $facebook_link;
    public $twitter_link;
    public $linked_in_link;
    public $youtube_link;
    public $google_plus_link;
    public $info_email;
    public $google_maps_widget;
    public $facebook_widget;
    public $twitter_widget;
    public $cm_cs_image;
    public $cm_cs_message_title;
    public $cm_cs_message_description;
    public $hod_image;
    public $hod_message_title;
    public $hod_message_description;
    public $enabled_what_we_do_panel;
    public $enabled_hod_message;
    public $enabled_downloads_cm_msg_panel;
    public $enabled_top_stories_panel;
    public $enabled_fb_twitter_feed_panel;
    public $mail_transport;
    public $mail_host;
    public $mail_port;
    public $mail_username;
    public $mail_password;
    public $mail_encryption;
    public $rules_reg_short_description;
    public $rules_reg_page_content;
    public $tender_guidelines_short_description;
    public $tender_guidelines_page_content;
    public $bidding_documents_short_description;
    public $bidding_documents_page_content;
    public $tender_instructions_short_description;
    public $tender_instructions_page_content;
    public $public_procurement_short_description;
    public $public_procurement_page_content;
    public $standing_instructions_short_description;
    public $standing_instructions_page_content;

    protected static function shouldRegisterNavigation(): bool
    {
        if(auth()->user()->user_role == 0) {
            return true;
        } else if(auth()->user()->user_role == 1) {
            return true;
        } else {
            return false;
        }
    }


    public function mount(): void
    {
        if(auth()->user()->user_role == 2) {
            abort(Response::HTTP_NOT_FOUND);
        }

        $gs = GeneralSetting::find(1);
        $this->gs = $gs;
        $this->form->fill([
            'meta_description' => $this->gs->meta_description,
            'meta_keywords' => $this->gs->meta_keywords,
            'meta_author' => $this->gs->meta_author,
            'department_full_name' => $this->gs->department_full_name,
            'department_short_name' => $this->gs->department_short_name,
            'department_description' => $this->gs->department_description,
            'department_logo' => $this->gs->department_logo,
            'global_phone_no' => $this->gs->global_phone_no,
            'global_mobile_no' => $this->gs->global_mobile_no,
            'global_address' => $this->gs->global_address,
            'facebook_link' => $this->gs->facebook_link,
            'twitter_link' => $this->gs->twitter_link,
            'linked_in_link' => $this->gs->linked_in_link,
            'youtube_link' => $this->gs->youtube_link,
            'google_plus_link' => $this->gs->google_plus_link,
            'info_email' => $this->gs->info_email,
            'google_maps_widget' => $this->gs->google_maps_widget,
            'facebook_widget' => $this->gs->facebook_widget,
            'twitter_widget' => $this->gs->twitter_widget,
            'cm_cs_image' => $this->gs->cm_cs_image,
            'cm_cs_message_title' => $this->gs->cm_cs_message_title,
            'cm_cs_message_description' => $this->gs->cm_cs_message_description,
            'hod_image' => $this->gs->hod_image,
            'hod_message_title' => $this->gs->hod_message_title,
            'hod_message_description' => $this->gs->hod_message_description,
            'enabled_what_we_do_panel' => $this->gs->enabled_what_we_do_panel,
            'enabled_hod_message' => $this->gs->enabled_hod_message,
            'enabled_downloads_cm_msg_panel' => $this->gs->enabled_downloads_cm_msg_panel,
            'enabled_top_stories_panel' => $this->gs->enabled_top_stories_panel,
            'enabled_fb_twitter_feed_panel' => $this->gs->enabled_fb_twitter_feed_panel,
            'enabled_our_projects_panel' => $this->gs->enabled_our_projects_panel,
            'mail_transport' => $this->gs->mail_transport,
            'mail_host' => $this->gs->mail_host,
            'mail_port' => $this->gs->mail_port,
            'mail_username' => $this->gs->mail_username,
            'mail_password' => $this->gs->mail_password,
            'mail_encryption' => $this->gs->mail_encryption,
            'rules_reg_short_description' => $this->gs->rules_reg_short_description,
            'rules_reg_page_content' => $this->gs->rules_reg_page_content,
            'tender_guidelines_short_description' => $this->gs->tender_guidelines_short_description,
            'tender_guidelines_page_content' => $this->gs->tender_guidelines_page_content,
            'bidding_documents_short_description' => $this->gs->bidding_documents_short_description,
            'bidding_documents_page_content' => $this->gs->bidding_documents_page_content,
            'tender_instructions_short_description' => $this->gs->tender_instructions_short_description,
            'tender_instructions_page_content' => $this->gs->tender_instructions_page_content,
            'public_procurement_short_description' => $this->gs->public_procurement_short_description,
            'public_procurement_page_content' => $this->gs->public_procurement_page_content,
            'standing_instructions_short_description' => $this->gs->standing_instructions_short_description,
            'standing_instructions_page_content' => $this->gs->standing_instructions_page_content,
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            /* Forms\Components\TextInput::make('department_full_name')->required(),
            Forms\Components\MarkdownEditor::make('department_logo'), */
            // ...

            Tabs::make('Heading')
                    ->tabs([
                        /* Tabs\Tab::make('Department Details')
                            ->schema([
                                Forms\Components\TextInput::make('department_full_name')
                                    ->required()
                                    ->minLength(3)
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('department_short_name')
                                    ->minLength(3)
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('department_description')
                                    ->minLength(3)
                                    ->maxLength(65535),
                                Forms\Components\FileUpload::make('department_logo')
                                    ->image()
                                    ->directory('images')
                                    // ->imageResizeMode('force')
                                    // ->imageCropAspectRatio('2:2')
                                    // ->imageResizeTargetWidth('200')
                                    // ->imageResizeTargetHeight('200')
                                    ->required(),

                                // Cropper::make('department_logo')
                                //     ->directory('images')
                                //     ->enableDownload()
                                //     ->enableOpen()
                                //     ->enableImageRotation()
                                //     ->enableImageFlipping()
                                //     ->imageCropAspectRatio('1:1')
                                //     ->modalSize('x1')
                                //     ->required(),
                                Forms\Components\FileUpload::make('organogram_image')
                                    ->image()
                                    ->directory('images')
                                    ->required(),
                            ]), */
                        Tabs\Tab::make('Contact / Social Media')
                            ->schema([
                                Forms\Components\TextInput::make('global_phone_no')
                                    ->minLength(3)
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('global_mobile_no')
                                    ->minLength(3)
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('global_address')
                                    ->minLength(3)
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('facebook_link')
                                    ->url()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('twitter_link')
                                    ->url()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('linked_in_link')
                                    ->url()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('youtube_link')
                                    ->url()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('google_plus_link')
                                    ->url()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('info_email')
                                    ->email()
                                    ->maxLength(255),
                            ]),
                        /* Tabs\Tab::make('Testimonials')
                            ->schema([
                                Forms\Components\FileUpload::make('cm_cs_image')
                                    ->label('Cheif Minister / Chief Secretary Image ')
                                    ->image()
                                    ->directory('images'),
                                    // ->imageResizeMode('cover')
                                    // ->imageCropAspectRatio('16:10')
                                    // ->imageResizeTargetWidth('450')
                                    // ->imageResizeTargetHeight('270'),
                                // Cropper::make('cm_cs_image')
                                //     ->label('Cheif Minister / Chief Secretary Image ')
                                //     ->directory('images')
                                //     ->enableDownload()
                                //     ->enableOpen()
                                //     ->enableImageRotation()
                                //     ->enableImageFlipping()
                                //     ->imageCropAspectRatio('16:10')
                                //     ->modalSize('x1')
                                //     ->required(),

                                Forms\Components\TextInput::make('cm_cs_message_title')
                                    ->label('Cheif Minister / Chief Secretary Message Title')
                                    ->minLength(3)
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('cm_cs_message_description')
                                    ->label('Cheif Minister / Chief Secretary Message')
                                    ->minLength(3)
                                    ->maxLength(65535),
                                Forms\Components\FileUpload::make('hod_image')
                                    ->label('Head of Department Image')
                                    ->image()
                                    ->directory('images'),
                                    // ->imageResizeMode('cover')
                                    // ->imageCropAspectRatio('16:10')
                                    // ->imageResizeTargetWidth('450')
                                    // ->imageResizeTargetHeight('270'),
                                // Cropper::make('hod_image')
                                //     ->label('Head of Department Image')
                                //     ->directory('images')
                                //     ->enableDownload()
                                //     ->enableOpen()
                                //     ->enableImageRotation()
                                //     ->enableImageFlipping()
                                //     ->imageCropAspectRatio('16:10')
                                //     ->modalSize('x1')
                                //     ->required(),
                                Forms\Components\TextInput::make('hod_message_title')
                                    ->label('Head of Department Message Title')
                                    ->minLength(3)
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('hod_message_description')
                                    ->label('Head of Department Message')
                                    ->minLength(3)
                                    ->maxLength(65535),
                            ]), */
                        Tabs\Tab::make('SEO / Meta Settings')
                            ->schema([
                                Forms\Components\Textarea::make('meta_description')
                                    ->maxLength(65535),
                                Forms\Components\Textarea::make('meta_keywords')
                                    ->maxLength(65535),
                                Forms\Components\TextInput::make('meta_author')
                                    ->maxLength(255),
                            ]),
                        Tabs\Tab::make('Social Widgets')
                            ->schema([
                                Forms\Components\Textarea::make('google_maps_widget')
                                    ->maxLength(65535),
                                Forms\Components\Textarea::make('facebook_widget')
                                    ->maxLength(65535),
                                Forms\Components\Textarea::make('twitter_widget')
                                    ->maxLength(65535),
                            ]),
                        /* Tabs\Tab::make('Mail Settings')
                            ->schema([
                                Forms\Components\Toggle::make('is_enabled_mail')
                                    ->label('Enable Mail')
                                    ->reactive()
                                    ->required()
                                    ->afterStateHydrated(function($set){
                                        $set('is_enabled_mail', GeneralSetting::find(1)->is_enabled_mail);
                                    }),
                                Forms\Components\TextInput::make('mail_transport')
                                    ->required(function($get){
                                        $ap_t = $get('is_enabled_mail');
                                        if($ap_t) {
                                            return true;
                                        }

                                        return false;
                                    })
                                    ->disabled(function($get){
                                        $ap_t = $get('is_enabled_mail');

                                        if($ap_t) {
                                            return false;
                                        }

                                        return true;
                                    }),
                                Forms\Components\TextInput::make('mail_host')
                                    ->required(function($get){
                                        $ap_t = $get('is_enabled_mail');
                                        if($ap_t) {
                                            return true;
                                        }

                                        return false;
                                    })
                                    ->disabled(function($get){
                                        $ap_t = $get('is_enabled_mail');

                                        if($ap_t) {
                                            return false;
                                        }

                                        return true;
                                    }),
                                Forms\Components\TextInput::make('mail_port')
                                    ->integer()
                                    ->required(function($get){
                                        $ap_t = $get('is_enabled_mail');
                                        if($ap_t) {
                                            return true;
                                        }

                                        return false;
                                    })
                                    ->disabled(function($get){
                                        $ap_t = $get('is_enabled_mail');

                                        if($ap_t) {
                                            return false;
                                        }

                                        return true;
                                    }),
                                Forms\Components\TextInput::make('mail_username')
                                    ->required(function($get){
                                        $ap_t = $get('is_enabled_mail');
                                        if($ap_t) {
                                            return true;
                                        }

                                        return false;
                                    })
                                    ->disabled(function($get){
                                        $ap_t = $get('is_enabled_mail');

                                        if($ap_t) {
                                            return false;
                                        }

                                        return true;
                                    }),
                                Forms\Components\TextInput::make('mail_password')
                                    ->password()
                                    ->required(function($get){
                                        $ap_t = $get('is_enabled_mail');
                                        if($ap_t) {
                                            return true;
                                        }

                                        return false;
                                    })
                                    ->disabled(function($get){
                                        $ap_t = $get('is_enabled_mail');

                                        if($ap_t) {
                                            return false;
                                        }

                                        return true;
                                    }),
                                Forms\Components\TextInput::make('mail_encryption')
                                    ->required(function($get){
                                        $ap_t = $get('is_enabled_mail');
                                        if($ap_t) {
                                            return true;
                                        }

                                        return false;
                                    })
                                    ->disabled(function($get){
                                        $ap_t = $get('is_enabled_mail');

                                        if($ap_t) {
                                            return false;
                                        }

                                        return true;
                                    }),
                            ]), */
                        /* Tabs\Tab::make('Actions')
                            ->schema([
                                Forms\Components\Toggle::make('enabled_what_we_do_panel')
                                    ->label('Enable / Disable "What We Do Panel".')
                                    ->required(),
                                Forms\Components\Toggle::make('enabled_hod_message')
                                    ->label('Enable / Disable "Head of Department Message Panel".')
                                    ->required(),
                                Forms\Components\Toggle::make('enabled_downloads_cm_msg_panel')
                                    ->label('Enable / Disable "Downloads / CM / CS Message Panel".')
                                    ->required(),
                                Forms\Components\Toggle::make('enabled_top_stories_panel')
                                    ->label('Enable / Disable "Top Stories Panel".')
                                    ->required(),
                                Forms\Components\Toggle::make('enabled_fb_twitter_feed_panel')
                                    ->label('Enable / Disable "Twitter / Facebook Feed Panel".')
                                    ->required(),
                                Forms\Components\Toggle::make('enabled_our_projects_panel')
                                    ->label('Enable / Disable "Our Projects Panel".')
                                    ->required(),
                            ]), */
                            Tabs\Tab::make('Rules / Regulations')
                            ->schema([
                                Forms\Components\Textarea::make('rules_reg_short_description')
                                    ->minLength(3),
                                Forms\Components\RichEditor::make('rules_reg_page_content')
                                    ->toolbarButtons([
                                        'attachFiles',
                                        'blockquote',
                                        'bold',
                                        'bulletList',
                                        'codeBlock',
                                        'h2',
                                        'h3',
                                        'italic',
                                        'link',
                                        'orderedList',
                                        'redo',
                                        'strike',
                                        'underline',
                                        'undo',
                                    ])
                            ]),
                        Tabs\Tab::make('Tender Guidelines')
                            ->schema([
                                Forms\Components\Textarea::make('tender_guidelines_short_description')
                                    ->minLength(3),
                                Forms\Components\RichEditor::make('tender_guidelines_page_content')
                                    ->toolbarButtons([
                                        'attachFiles',
                                        'blockquote',
                                        'bold',
                                        'bulletList',
                                        'codeBlock',
                                        'h2',
                                        'h3',
                                        'italic',
                                        'link',
                                        'orderedList',
                                        'redo',
                                        'strike',
                                        'underline',
                                        'undo',
                                    ])
                            ]),
                        Tabs\Tab::make('Bidding Documents')
                            ->schema([
                                Forms\Components\Textarea::make('bidding_documents_short_description')
                                    ->minLength(3),
                                Forms\Components\RichEditor::make('bidding_documents_page_content')
                                    ->toolbarButtons([
                                        'attachFiles',
                                        'blockquote',
                                        'bold',
                                        'bulletList',
                                        'codeBlock',
                                        'h2',
                                        'h3',
                                        'italic',
                                        'link',
                                        'orderedList',
                                        'redo',
                                        'strike',
                                        'underline',
                                        'undo',
                                    ])
                            ]),
                        Tabs\Tab::make('Tender Instructions')
                            ->schema([
                                Forms\Components\Textarea::make('tender_instructions_short_description')
                                    ->minLength(3),
                                Forms\Components\RichEditor::make('tender_instructions_page_content')
                                    ->toolbarButtons([
                                        'attachFiles',
                                        'blockquote',
                                        'bold',
                                        'bulletList',
                                        'codeBlock',
                                        'h2',
                                        'h3',
                                        'italic',
                                        'link',
                                        'orderedList',
                                        'redo',
                                        'strike',
                                        'underline',
                                        'undo',
                                    ])
                            ]),
                        Tabs\Tab::make('Public Procurement')
                            ->schema([
                                Forms\Components\Textarea::make('public_procurement_short_description')
                                    ->minLength(3),
                                Forms\Components\RichEditor::make('public_procurement_page_content')
                                    ->toolbarButtons([
                                        'attachFiles',
                                        'blockquote',
                                        'bold',
                                        'bulletList',
                                        'codeBlock',
                                        'h2',
                                        'h3',
                                        'italic',
                                        'link',
                                        'orderedList',
                                        'redo',
                                        'strike',
                                        'underline',
                                        'undo',
                                    ])
                            ]),
                        Tabs\Tab::make('Standing Instructions')
                            ->schema([
                                Forms\Components\Textarea::make('standing_instructions_short_description')
                                    ->minLength(3),
                                Forms\Components\RichEditor::make('standing_instructions_page_content')
                                    ->toolbarButtons([
                                        'attachFiles',
                                        'blockquote',
                                        'bold',
                                        'bulletList',
                                        'codeBlock',
                                        'h2',
                                        'h3',
                                        'italic',
                                        'link',
                                        'orderedList',
                                        'redo',
                                        'strike',
                                        'underline',
                                        'undo',
                                    ])
                            ]),

                        ]),
        ];
    }

    protected function getFormModel(): GeneralSetting
    {
        return $this->gs;
    }

    /* public function save(): void
    {
        $this->gs->update(
            $this->form->getState(),
        );
    }
 */
    public function submit(): void
    {
        $this->gs->update(
            $this->form->getState(),
        );

        Notification::make()
            ->title('Record saved successfully')
            ->success()
            ->send();
    }

    /* public function save()
    {
        $validateData = [
            'password' => [
                'required',
                'string',
                'different:old_password',
                'min:8',             // must be at least 8 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[0-9]/',      // must contain at least one digit
            ],
            'old_password' => [
                'required',

                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, auth()->user()->password)) {
                        $fail('Your old password does not match.');
                    }
                }
            ],
            'confirm_password' => 'required|min:8|same:password'
        ];

        $this->validate($validateData);

        $user = User::find(auth()->user()->id);
        $user->password = Hash::make($this->password);
        $user->remember_token = Str::random(60);
        $user->save();

        Session::flush();

        return redirect()->route('filament.auth.login');
    } */
}
