<?php

namespace App\Http\Controllers\Admin;
use App\Models\Admin\Lang;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FeedBackRequest;
use App\Http\Requests\Admin\UpdateFeedbackRequest;
use App\Models\Admin\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class FeedBackController extends Controller
{
    private $langs;
    public function __construct()
    {
        $this->langs = Lang::all();
    }


    
    public function index()
    {
        $feedbacks = Feedback::withTrashed()->get();
        return view('admin.feedback.index' , ['feedbacks' => $feedbacks , 'langs' => $this->langs]);
    }

    public function create()
    {
        return view('admin.feedback.add' , ['langs'=>$this->langs]);

    } // end create function


    public function edit($id)
    {
        $feedback = Feedback::findOrFail($id);
        return view('admin.feedback.update' , ['feedback'=> $feedback , 'langs'=> $this->langs]);

    }



    public function store(FeedBackRequest $request)
    {

        try {


            // Start the database transaction
            $image_name = $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/images/feedbacks'), $image_name);
            $icon_name = null;
            if ($request->hasFile('icon')) {
                $icon_name = $request->icon->getClientOriginalName();
                $request->icon->move(public_path('uploads/images/feedbacks'), $icon_name);
    

            }
            DB::beginTransaction();

           
            $feedback = Feedback::create([
                'image'=>$image_name,
                'icon'=>$icon_name
            ]);
   
            foreach ($this->langs as $lang) {
                $feedback->{'name:'.$lang->code}  = $request->name[$lang->code];
                $feedback->{'des:'.$lang->code}  = $request->des[$lang->code];
                $feedback->{'small_des:'.$lang->code}  = $request->small_des[$lang->code];
            }
            $feedback->save();
            DB::commit();
            Alert::success('Success', 'Your slider is saved !');
            return redirect()->route('admin.feedback.index');

        } catch (\Exception $e) {
            dd($e->getLine() , $e->getMessage());
            // If an exception occurs, rollback the transaction
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.feedback.index');
        }
    }// end function store




    public function update(UpdateFeedbackRequest $request , $id)
    {
        try {

            $feed = Feedback::findOrFail($id);
            $image_name = $feed->image;
            if($request->has('image')){
                $image_name = $request->image->getClientOriginalName();
                $request->image->move(public_path('uploads/images/feedbacks'), $image_name);
                if (file_exists(public_path('uploads/images/feedbacks/' .$feed->image))) {
                    unlink(public_path('uploads/images/feedbacks/' .$feed->image));
                }
            }


             $icon_name = null;
            if($request->has('icon')){
                $icon_name = $request->icon->getClientOriginalName();
                $request->icon->move(public_path('uploads/images/feedbacks'), $icon_name);
                if (file_exists(public_path('uploads/images/feedbacks/' .$feed->icon_name))) {
                    unlink(public_path('uploads/images/feedbacks/' .$feed->icon_name));
                }
            }



            DB::beginTransaction();
            $feed->update(
                [
                    'image'=>$image_name,
                    'icon'=>$icon_name
                ]
            );

            foreach ($this->langs as $lang) {
                $feed->{'name:'.$lang->code}       = $request->name[$lang->code];
                $feed->{'des:'.$lang->code}  = $request->des[$lang->code];
                $feed->{'small_des:'.$lang->code}  = $request->small_des[$lang->code];
            }
            
            $feed->save();
            DB::commit();
            Alert::success('success', 'Feedback Updated Successfully !');
            return redirect()->route('admin.feedback.index');

        }catch (\Exception $e){
            // If an exception occurs, rollback the transaction
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.feedback.index');
        }

    } // end update laravel




    public function destroy($id)
    {
        $feed = Feedback::findOrFail($id);
        $feed->forceDelete();
        Alert::success('success', 'Feedback Deleted Successfully !');
        return redirect()->route('admin.feedback.index');
    }

    public function soft_delete($id)
    {
        $feed = Feedback::findOrFail($id);
        $feed->delete();
        Alert::success('success', 'Feedback Soft Deleted Successfully !');
        return redirect()->route('admin.feedback.index');

    }

    public function restore($id)
    {
        $feed = Feedback::withTrashed()->findOrFail($id);
        $feed->restore();
        Alert::success('success', 'Feedback Restored Successfully !');
        return redirect()->route('admin.feedback.index');

    }









}
