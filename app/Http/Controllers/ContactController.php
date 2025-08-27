<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('contactus');
    }

    public function submitForm(Request $request)
    {
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject_ar' => 'nullable|string|max:255',
            'subject_en' => 'nullable|string|max:255',
            'message_ar' => 'required|string',
            'message_en' => 'required|string',
        ]);


    $contact = new \App\Models\Contact();
    $contact->setTranslation('name', 'ar', $validated['name_ar']);
    $contact->setTranslation('name', 'en', $validated['name_en']);
    $contact->email = $validated['email'];
    $contact->phone = $validated['phone'] ?? null;
    $contact->setTranslation('subject', 'ar', $validated['subject_ar'] ?? '');
    $contact->setTranslation('subject', 'en', $validated['subject_en'] ?? '');
    $contact->setTranslation('message', 'ar', $validated['message_ar']);
    $contact->setTranslation('message', 'en', $validated['message_en']);
    $contact->save();

    return redirect()->back()->with('success', __('messages.contact_success'));
    }
}
