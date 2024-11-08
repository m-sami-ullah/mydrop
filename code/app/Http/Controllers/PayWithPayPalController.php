<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Package;
use App\Traits\WebResponser;
use Auth;
use DB;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
// use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayWithPayPalController extends Controller
{
	use WebResponser;
    public function payment(Request $request,Package $plan)
    {

    	try {
            DB::beginTransaction();

            if (!$plan) {
	    		new \Exception('Invalid Plan selected!');
	    	}

	    	$total = $plan->price;
	    	$tax   = 0;
	    	$payment_type   = 'Paypal';
	    	$invoice_status   = 1;
	    	$status   = 1;

	    	

	    	$provider = new PayPalClient;
	        $provider->setApiCredentials(config('paypal'));
	        $paypalToken = $provider->getAccessToken();

	        $response = $provider->createOrder([
	            "intent" => "CAPTURE",
	            "application_context" => [
	                "return_url" => route('payment.success'),
	                "cancel_url" => route('payment.cancel'),
	            ],
	            "purchase_units" => [
	                0 => [
	                    "amount" => [
	                        "currency_code" => "USD",
	                        "value" => $total
	                    ]
	                ]
	            ]
	        ]);

	        // dd($response);
    		// dd($provider,$request->all(),$plan);



	        if (isset($response['id']) && $response['id'] != null) {

	    		// $invoice_number   = $response['id'];//date('dmy').'-'.rand(1000,9999).'INV-'.Auth::guard('customer')->user()->id;
	        	// $data = ['customer_id'=>Auth::guard('customer')->user()->id,'address_id'=>1,'package_id'=>$plan->id,'package'=>$plan->name,'price'=>$plan->price,'total'=>$total,'tax'=>$tax,'payment_type'=>$payment_type,'invoice_number'=>$invoice_number,'invoice_status'=>$invoice_status,'status'=>$status];
	    		// Order::create($data);
	            
	            // redirect to approve href
	            foreach ($response['links'] as $links) 
	            {
	                if ($links['rel'] == 'approve') 
	                {
	                    return redirect()->away($links['href']);
	                }
	            }

	            return redirect()
	                ->route('createTransaction')
	                ->with('error', 'Something went wrong.');

	        } else {
	            return redirect()
	                ->route('createTransaction')
	                ->with('error', $response['message'] ?? 'Something went wrong.');
	        }
            // $record = $this->areaservice->store($request);
            $this->success('Your Order submit successfully');
            DB::commit();
            return redirect()->route('thanks.url');
        }catch (\Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    

    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        dd($response);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') 
        {

        	
            return redirect()
                ->route('createTransaction')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('createTransaction')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction(Request $request)
    {
        return redirect()
            ->route('payment.cancel')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }
}

/*$data = [];

	         $data = json_decode('{
				    "intent": "CAPTURE",
				    "purchase_units": [
				      {
				        "amount": {
				          "currency_code": "AED",
				          "value": "100.00"
				        }
				      }
				    ]
				}', true);

				

	  

	        $provider = \PayPal::setProvider();

	        // $token = $provider->getAccessToken();
	        // dd($token);
			/*
			        $data = json_decode('{
			  "detail": {
			    "invoice_number": "#123",
			    "reference": "deal-ref",
			    "invoice_date": "2018-11-12",
			    "currency_code": "USD",
			    "note": "Thank you for your business.",
			    "term": "No refunds after 30 days.",
			    "memo": "This is a long contract",
			    "payment_term": {
			      "term_type": "NET_10",
			      "due_date": "2018-11-22"
			    }
			  },
			  "invoicer": {
			    "name": {
			      "given_name": "David",
			      "surname": "Larusso"
			    },
			    "website": "www.test.com",
			    "tax_id": "ABcNkWSfb5ICTt73nD3QON1fnnpgNKBy- Jb5SeuGj185MNNw6g",
			    "logo_url": "https://example.com/logo.PNG",
			    "additional_notes": "2-4"
			  },
			  "primary_recipients": [
			    {
			      "billing_info": {
			        "name": {
			          "given_name": "Stephanie",
			          "surname": "Meyers"
			        },
			        "address": {
			          "address_line_1": "1234 Main Street",
			          "admin_area_2": "Anytown",
			          "admin_area_1": "CA",
			          "postal_code": "98765",
			          "country_code": "US"
			        },
			        "email_address": "bill-me@example.com",
			        "phones": [
			          {
			            "country_code": "001",
			            "national_number": "4884551234",
			            "phone_type": "HOME"
			          }
			        ],
			        "additional_info_value": "add-info"
			      },
			      "shipping_info": {
			        "name": {
			          "given_name": "Stephanie",
			          "surname": "Meyers"
			        },
			        "address": {
			          "address_line_1": "1234 Main Street",
			          "admin_area_2": "Anytown",
			          "admin_area_1": "CA",
			          "postal_code": "98765",
			          "country_code": "US"
			        }
			      }
			    }
			  ],
			  "items": [
			    {
			      "name": "Yoga Mat",
			      "description": "Elastic mat to practice yoga.",
			      "quantity": "1",
			      "unit_amount": {
			        "currency_code": "USD",
			        "value": "50.00"
			      },
			      "tax": {
			        "name": "Sales Tax",
			        "percent": "7.25"
			      },
			      "discount": {
			        "percent": "5"
			      },
			      "unit_of_measure": "QUANTITY"
			    },
			    
			  ],
			   
			}', true);*/

			// $invoice = $provider->createInvoice($data);
			  		/*$order = $provider->createOrder($data);

			  		dd($order);

			        return redirect($response['paypal_link']);*/