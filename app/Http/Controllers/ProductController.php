<?php

namespace App\Http\Controllers;

use App\Models\{Product, ProductImage};
use Illuminate\Http\Request;
use Mail;

class ProductController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    public function edit(Product $product) {
        return view('product.edit', compact('product'));
    }

    public function productImages(Request $request) {
        $product = Product::find($request->productid);
        $productimages = $request->productimages;
        foreach ($productimages as $imagefile) {
            $newFileName = rand(111, 999) . time() . rand(111, 999) . '.' . $imagefile->getClientOriginalExtension();
            $imagefile->move(public_path('images/product'), $newFileName);
            $ProductImage = new ProductImage;

            $ProductImage->product_image_url = $newFileName;
            $ProductImage->product_id = $product->id;
            $ProductImage->save();
        }
        return back()->with('img_success', 'Multiple Images for '. $product->name .'uploaded successfuly!');
    }

    public function enquiry(Product $product, Request $request) {
        $this->validate($request, [
            'fullname' => 'required',
            'email' => 'required|email',
            'comment' => 'required'
        ],
        [
            'fullname.required' => 'Provide Full name.',
            'email.required' => 'Provide your Email.',
            'email.email' => 'Email must be in valide formate.',
            'comment.required' => 'Tell us more about your query.',
        ]);

        $mailContent = [
            'productname' => $product->name,
            'enquiryfrom' => $request->get('fullname'),
            'enquiryemail' => $request->get('email'),
            'enquiry' => $request->get('comment')
        ];

        Mail::send('emails.enquiry', $mailContent,
            function ($message) use($product) {
                    $message->from('lsi@lsi.co.uk');
                    $message->to('test@lsi.co.uk', 'LSI Enquiry')
                    ->subject('Enquiry for ' . $product->name);
        });

        return back()->with('success', 'Thanks for enquiry for '. $product->name .', Some one from our staff will get back to you soon!');
    }
    
}
