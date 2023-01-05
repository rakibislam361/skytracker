<?php

namespace App\Http\Controllers\Backend\Content;

use App\Http\Controllers\Controller;
use App\Models\Content\Setting;
use App\Models\Info;
use App\Models\Page;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{

  public function general()
  {
    return view('backend.content.settings.general.general');
  }

  public function logoStore(Request $request)
  {
    if (\request()->hasFile('frontend_logo_menu')) {
      $data['frontend_logo_menu'] = store_picture(\request()->file('frontend_logo_menu'), 'setting/logo');
    }
    if (\request()->hasFile('frontend_logo_footer')) {
      $data['frontend_logo_footer'] = store_picture(\request()->file('frontend_logo_footer'), 'setting/logo');
    }
    if (\request()->hasFile('admin_logo')) {
      $data['admin_logo'] = store_picture(\request()->file('admin_logo'), 'setting/logo');
    }
    if (\request()->hasFile('favicon')) {
      $data['favicon'] = store_picture(\request()->file('favicon'), 'setting/logo');
    }
    Setting::save_settings($data);

    return redirect()->back()->withFlashSuccess('Logo Updated Successfully');
  }
  public function bannerstore(Request $request)
  {

    if (\request()->hasFile('banner_image')) {

      $data['banner_image'] = store_picture(\request()->file('banner_image'), 'setting/logo');
      Setting::save_settings($data);
    }
    if (\request()->hasFile('banner_image_back')) {

      $data['banner_image_back'] = store_picture(\request()->file('banner_image_back'), 'setting/logo');
      Setting::save_settings($data);
    }

    
    $data = \request()->only(['banner_color_1','banner_color_2','banner_color_3','banner_text_header', 'banner_text_bottom']);
    Setting::save_settings($data);
    return redirect()->back()->withFlashSuccess('Banner section Updated Successfully');
  }
  public function bottombanner(Request $request)
  {

    if (\request()->hasFile('bottombanner_image')) {

      $data['bottombanner_image'] = store_picture(\request()->file('bottombanner_image'), 'setting/logo');
      Setting::save_settings($data);
    }

    $data = \request()->only(['btbanner_color_1','btbanner_color_2','btbanner_color_3','bottombanner_text_header', 'bottombanner_text_bottom','bottom_bg_color','bottom_video_link']);
    Setting::save_settings($data);
    return redirect()->back()->withFlashSuccess('Bottom Banner section Updated Successfully');
  }
  public function noticecolorstore(Request $request)
  {
  
    if (\request()->hasFile('notice_image')) {
 
      $data['notice_image'] = store_picture(\request()->file('notice_image'), 'setting/logo');
      Setting::save_settings($data);
    }

    $data = \request()->only(['notice_color_1','notice_color_2','notice_color_3']);
    Setting::save_settings($data);
    return redirect()->back()->withFlashSuccess('Bottom Banner section Updated Successfully');
  }
  public function aboutstore(Request $request)
  {

    if (\request()->hasFile('about_image_1')) {

      $data['about_image_1'] = store_picture(\request()->file('about_image_1'), 'setting/logo');
      Setting::save_settings($data);
    }
    if (\request()->hasFile('about_image_2')) {

      $data['about_image_2'] = store_picture(\request()->file('about_image_2'), 'setting/logo');
      Setting::save_settings($data);
    }
    if (\request()->hasFile('about_image_3')) {

      $data['about_image_3'] = store_picture(\request()->file('about_image_3'), 'setting/logo');
      Setting::save_settings($data);
    }
    if (\request()->hasFile('about_image_4')) {

      $data['about_image_4'] = store_picture(\request()->file('about_image_4'), 'setting/logo');
      Setting::save_settings($data);
    }
    if (\request()->hasFile('about_image_5')) {

      $data['about_image_5'] = store_picture(\request()->file('about_image_5'), 'setting/logo');
      Setting::save_settings($data);
    }
    if (\request()->hasFile('about_image_6')) {

      $data['about_image_6'] = store_picture(\request()->file('about_image_6'), 'setting/logo');
      Setting::save_settings($data);
    }

    
    $data = \request()->only(['about_color_1','about_color_2','about_color_3','about_text_header', 'about_text_bottom','about_text_details','about_image_title_1','about_image_title_2','about_image_title_3','about_image_title_4','about_image_title_5','about_image_title_6']);
    Setting::save_settings($data);
    return redirect()->back()->withFlashSuccess('About section Updated Successfully');
  }
  public function apiStore(Request $request)
  {

    $data = \request()->only(['api_url','api_email','api_password']);
    Setting::save_settings($data);
    return redirect()->back()->withFlashSuccess('Api section Updated Successfully');
  }
  public function workstore(Request $request)
  {

    if (\request()->hasFile('work_image_1')) {

      $data['work_image_1'] = store_picture(\request()->file('work_image_1'), 'setting/logo');
      Setting::save_settings($data);
    }
    if (\request()->hasFile('work_image_2')) {

      $data['work_image_2'] = store_picture(\request()->file('work_image_2'), 'setting/logo');
      Setting::save_settings($data);
    }
    if (\request()->hasFile('work_image_3')) {

      $data['work_image_3'] = store_picture(\request()->file('work_image_3'), 'setting/logo');
      Setting::save_settings($data);
    }
    
    
    $data = \request()->only(['work_color_1','work_color_2','work_color_3','work_text_header', 'work_image_title_1','work_image_title_2','work_image_title_3','work_image_bottom_1','work_image_bottom_2','work_image_bottom_3']);
    Setting::save_settings($data);
    return redirect()->back()->withFlashSuccess('About section Updated Successfully');
  }

  public function socialStore(Request $request)
  {
    $data = request()->all();
    unset($data['_token']);

    if (\request()->hasFile('meta_image')) {
      $data['meta_image'] = store_picture(\request()->file('meta_image'), 'setting/meta');
    }

    if (\request()->hasFile('invoice_logo')) {
      $data['invoice_logo'] = store_picture(\request()->file('invoice_logo'), 'setting/logo');
    }


    Setting::save_settings($data);

    return redirect()->back()->withFlashSuccess('Setting Updated Successfully');
  }


  public function price()
  {
    return view('backend.content.settings.price-setting');
  }
  public function notice()
  {
    return view('backend.content.settings.notice.index');
  }
  public function noticestore(Request $request)
  {
    foreach ($request->title  as $key => $title) {
      $newImageName = time() . '.' . $request->multiimage[$key]->extension();
      $image = $request->multiimage[$key]->move(public_path('setting/banner'), $newImageName);
      $notice = new Notice;
      $notice->image = $newImageName;
      $notice->title = $request->title[$key];
      $notice->description = $request->description[$key];
      $notice->save();
    }

    return redirect()->back()->withFlashSuccess('Notice Store Successfully');
  }
  public function noticeedit($id)
  {
    $notice = DB::table('notices')->find($id);
    return view('backend.content.settings.notice.edit', compact('notice'));
  }

  public function noticeupdate(Request $request)
  {
    $id = $request->notice_id;
    if ($request->image) {
      $newImageName = time() . '.' . $request->image->extension();
      $image = $request->image->move(public_path('setting/banner'), $newImageName);
    } else {
      $newImageName = $request->oldimage;
    }
    $notice = Notice::find($id);
    $notice->image = $newImageName;
    $notice->title = $request->title;
    $notice->description = $request->description;
    $notice->is_active = $request->is_active;
    $notice->save();
    return redirect('/admin/setting/notice')->withFlashSuccess('Notice Updated Successfully');;
  }
  public function info()
  {
    return view('backend.content.settings.info.index');
  }
  public function infostore(Request $request)
  {
    foreach ($request->title  as $key => $title) {
      $newImageName = time() . '.' . $request->multiimage[$key]->extension();
      $image = $request->multiimage[$key]->move(public_path('setting/banner'), $newImageName);
      $info = new Info;
      $info->image = $newImageName;
      $info->title = $request->title[$key];
      $info->description = $request->description[$key];
      $info->save();
    }

    return redirect()->back()->withFlashSuccess('Notice Store Successfully');
  }
  public function infoedit($id)
  {
    $notice = DB::table('infos')->find($id);
    return view('backend.content.settings.info.edit', compact('notice'));
  }

  public function infoupdate(Request $request)
  {
    $id = $request->notice_id;
    if ($request->image) {
      $newImageName = time() . '.' . $request->image->extension();
      $image = $request->image->move(public_path('setting/banner'), $newImageName);
    } else {
      $newImageName = $request->oldimage;
    }
    $info = Info::find($id);
    $info->image = $newImageName;
    $info->title = $request->title;
    $info->description = $request->description;
    $info->is_active = $request->is_active;
    $info->save();

    return redirect('/admin/setting/info')->withFlashSuccess('Notice Updated Successfully');;
  }
  public function page()
  {
    return view('backend.content.settings.page.index');
  }
  public function pagestore(Request $request)
  {
    $newImageName = time() . '.' . $request->image->extension();
      $image = $request->image->move(public_path('setting/banner'), $newImageName);
      $page =new Page;
      $page->image = $newImageName;
      $page->title = $request->title;
      $page->slug = $request->slug;
      $page->bgcolor = $request->bgcolor;
      $page->hearder = $request->hearder;
      $page->footer_left = $request->footer_left;
      $page->footer_right = $request->footer_right;
      $page->description = $request->description;
      $page->save();
    return redirect()->back()->withFlashSuccess('Page Create Successfully');
  }
  public function pageedit($id)
  {
    $notice = DB::table('pages')->find($id);
    return view('backend.content.settings.page.edit', compact('notice'));
  }

  public function pageupdate(Request $request)
  {
    $id = $request->notice_id;
    if ($request->image) {
      $newImageName = time() . '.' . $request->image->extension();
      $image = $request->image->move(public_path('setting/banner'), $newImageName);
    } else {
      $newImageName = $request->oldimage;
    }
    $page = Page::find($id);
    $page->image = $newImageName;
    $page->title = $request->title;
    $page->slug = $request->slug;
    $page->bgcolor = $request->bgcolor;
    $page->hearder = $request->hearder;
    $page->footer_left = $request->footer_left;
    $page->footer_right = $request->footer_right;
    $page->description = $request->description;
    $page->save();

    return redirect('/admin/setting/page')->withFlashSuccess('Notice Updated Successfully');;
  }
  public function limit()
  {
    return view('backend.content.settings.order-limit-setting');
  }


  public function limitationStore()
  {
    $data = request()->all();
    unset($data['_token']);

    Setting::save_settings($data);

    return redirect()->back()->withFlashSuccess('Setting Updated Successfully');
  }


  public function message()
  {
    return view('backend.content.settings.message-setting');
  }


  public function messageStore()
  {
    $sms = \request('sms') ? 'sms_' : '';
    if ($sms) {
      $data['sms_active_otp_message'] = \request('sms_active_otp_message', null);
      $data['sms_otp_message'] = \request('sms_otp_message', null);
    }
    $data[$sms . 'active_waiting_for_payment'] = \request($sms . 'active_waiting_for_payment', null);
    $data[$sms . 'waiting_for_payment'] = \request($sms . 'waiting_for_payment', null);
    $data[$sms . 'active_partial_paid'] = \request($sms . 'active_partial_paid', null);
    $data[$sms . 'partial_paid'] = \request($sms . 'partial_paid', null);
    $data[$sms . 'active_purchased_message'] = \request($sms . 'active_purchased_message', null);
    $data[$sms . 'purchased_message'] = \request($sms . 'purchased_message', null);
    $data[$sms . 'active_shipped_from_suppliers'] = \request($sms . 'active_shipped_from_suppliers', null);
    $data[$sms . 'shipped_from_suppliers'] = \request($sms . 'shipped_from_suppliers', null);
    $data[$sms . 'active_received_in_china_warehouse'] = \request($sms . 'active_received_in_china_warehouse', null);
    $data[$sms . 'received_in_china_warehouse'] = \request($sms . 'received_in_china_warehouse', null);
    $data[$sms . 'active_shipped_from_china_warehouse'] = \request($sms . 'active_shipped_from_china_warehouse', null);
    $data[$sms . 'shipped_from_china_warehouse'] = \request($sms . 'shipped_from_china_warehouse', null);
    $data[$sms . 'active_received_in_bd_warehouse'] = \request($sms . 'active_received_in_bd_warehouse', null);
    $data[$sms . 'received_in_bd_warehouse'] = \request($sms . 'received_in_bd_warehouse', null);
    $data[$sms . 'active_on_transit_to_customer'] = \request($sms . 'active_on_transit_to_customer', null);
    $data[$sms . 'on_transit_to_customer'] = \request($sms . 'on_transit_to_customer', null);
    $data[$sms . 'active_delivered_completed'] = \request($sms . 'active_delivered_completed', null);
    $data[$sms . 'delivered_completed'] = \request($sms . 'delivered_completed', null);
    $data[$sms . 'active_adjustment'] = \request($sms . 'active_adjustment', null);
    $data[$sms . 'adjustment'] = \request($sms . 'adjustment', null);
    $data[$sms . 'active_canceled_by_seller'] = \request($sms . 'active_canceled_by_seller', null);
    $data[$sms . 'canceled_by_seller'] = \request($sms . 'canceled_by_seller', null);
    $data[$sms . 'active_out_of_stock'] = \request($sms . 'active_out_of_stock', null);
    $data[$sms . 'out_of_stock'] = \request($sms . 'out_of_stock', null);
    $data[$sms . 'active_refunded'] = \request($sms . 'active_refunded', null);
    $data[$sms . 'refunded'] = \request($sms . 'refunded', null);

    Setting::save_settings($data);

    return redirect()->back()->withFlashSuccess('Message Updated Successfully');
  }


  public function airShippingStore()
  {
    $shipping = request('shipping');
    $data['air_shipping_charges'] = json_encode($shipping);
    Setting::save_settings($data);

    return redirect()->back()->withFlashSuccess('Shipping Charges Updated Successfully');
  }


  public function cacheControl()
  {
    $files = Storage::files('browsing');
    $displayInfo = [];
    foreach ($files as $file) {
      $explode_file = explode('_', $file);
      if (count($explode_file) == 3) {

        $date = $explode_file[0];
        $date = str_replace('browsing/', '', $date);
        $name = $explode_file[1];

        $selectFile = true;
        if (in_array('fullInfo', $explode_file)) {
          if (strtotime($date) < strtotime(date('Y-m-d-H'))) {
            Storage::delete($file);
            $selectFile = false;
          }
        } else {
          if (strtotime($date) < strtotime(date('Y-m-d'))) {
            Storage::delete($file);
            $selectFile = false;
          }
        }
        if ($selectFile) {
          $displayInfo[] = [
            'date' => $date,
            'name' => $name,
            'size' => Storage::size($file),
            'file' => $file,
          ];
        }
      } else {
        Storage::delete($file);
      }
    }

    $displayInfo = collect($displayInfo)->sortByDesc('date');

    return view('backend.content.settings.cache-control', compact('displayInfo'));
  }

  public function cacheClear()
  {
    $clearType = \request('type');
    if (Storage::exists($clearType)) {
      Storage::delete($clearType);
      Cache::forget('settings'); // remove setting cache
      return redirect()->back()->withFlashWarning('Browsing Cache Remove Successfully');
    }
    return redirect()->back()->withFlashDanger('Cache Type Not Found');
  }

  public function threeColumnBanner()
  {
    return view('backend.content.settings.banner-right');
  }


  public function bannerRightStore()
  {
    $data = request()->only('left_banner_image_link', 'middle_banner_image_link', 'right_banner_image_link');

    $rightBanner = json_decode(get_setting('three_column_banners'));

    if (\request()->hasFile('left_banner_image')) {
      $data['left_banner_image'] = store_picture(\request()->file('left_banner_image'), 'setting/banner');
    } else {
      $data['left_banner_image'] = $rightBanner->top_image ?? null;
    }
    if (\request()->hasFile('middle_banner_image')) {
      $data['middle_banner_image'] = store_picture(\request()->file('middle_banner_image'), 'setting/banner');
    } else {
      $data['middle_banner_image'] = $rightBanner->top_image ?? null;
    }
    if (\request()->hasFile('right_banner_image')) {
      $data['right_banner_image'] = store_picture(\request()->file('right_banner_image'), 'setting/banner');
    } else {
      $data['right_banner_image'] = $rightBanner->top_image ?? null;
    }

    Setting::save_settings(['three_column_banners' => json_encode($data)]);

    return redirect()->back()->withFlashSuccess('Three column banner image set successfully');
  }


  public function topNoticeCreate()
  {
    return view('backend.content.settings.top-notice');
  }

  public function topNoticeStore()
  {
    $active = request('top_notice_text_active');
    $top_notice_text = request('top_notice_text');

    $data['top_notice_text_active'] = null;
    if ($active) {
      $data['top_notice_text_active'] = $active;
    }
    $data['top_notice_text'] = $top_notice_text;

    Setting::save_settings($data);

    return redirect()->back()->withFlashSuccess('Top Notice Updated  Successfully');
  }

  public function createImageLoader()
  {
    return view('backend.content.settings.image-loader-setting');
  }

  public function storeImageLoader()
  {
    $data = [];
    if (\request()->hasFile('banner_image_loader')) {
      $data['banner_image_loader'] = store_picture(\request()->file('banner_image_loader'), 'setting/loader');
    }

    if (\request()->hasFile('category_image_loader')) {
      $data['category_image_loader'] = store_picture(\request()->file('category_image_loader'), 'setting/loader');
    }

    if (\request()->hasFile('sub_category_image_loader')) {
      $data['sub_category_image_loader'] = store_picture(\request()->file('sub_category_image_loader'), 'setting/loader');
    }

    if (\request()->hasFile('product_image_loader')) {
      $data['product_image_loader'] = store_picture(\request()->file('product_image_loader'), 'setting/loader');
    }

    Setting::save_settings($data);

    return redirect()->back()->withFlashSuccess('Loading Image Store Successfully');
  }

  public function rightBannerStore()
  {
    $data = request()->only('banner_right_link1');
    if (\request()->hasFile('banner_right_1')) {
      $data['banner_right_1'] = store_picture(\request()->file('banner_right_1'), 'setting/banner');
    }

    Setting::save_settings($data);

    return redirect()->back()->withFlashSuccess('Right Banner Store Successfully');
  }


  public function shortMessageStore()
  {
    $data = \request()->only(['approx_weight_message', 'china_local_delivery_message', 'china_to_bd_bottom_message', 'china_to_bd_bottom_message_2nd', 'order_summary_bottom_message', 'payment_summary_bottom_message']);
    Setting::save_settings($data);
    return redirect()->back()->withFlashSuccess('Short Message\'s Updated  Successfully');
  }
}
