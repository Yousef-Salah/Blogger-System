<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserInformationController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::user()->id);

        return view('dashboard.user.index', compact('user'));
    }

    public function edit()
    {
        $user = User::find(Auth::user()->id);

        return view('dashboard.user.edit', ['user' => $user]);
    }

    public function update(Request $request, $userID)
    {
        $user = User::find(Auth::user()->id);

        $request->validate($this->rules());

        $data = $request->all();
        $oldImage = $user->image;

        if($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('user_files', ['disk' => 'public']);
        } else {$data['image'] = $user->image;}
       
        $user->update($data);

        if($oldImage and  $oldImage != $data['image']) {
            Storage::disk('public')->delete($oldImage);
        }

        return redirect()->route('user.information.edit');
    }

    private function rules()
    {
        return[
            'name' => ['required', 'string', 'min:4', 'max:255'],
            'info' => ['nullable', 'string', 'min:4', 'max:500'],
            'image' => ['nullable', 'image'],
        ];
    }
}
