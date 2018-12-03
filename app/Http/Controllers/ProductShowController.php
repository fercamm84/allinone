<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Auth;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Section;
use App\Http\Requests\CreateMailingRequest;
use App\Http\Helpers\SendMailHelper;
use App\Repositories\MailingRepository;
use Illuminate\Http\Request;
use Flash;
use Response;

class ProductShowController extends Controller
{

    /** @var  MailingRepository */
    private $mailingRepository;

    private $SendMailHelper;

    public function __construct(MailingRepository $mailingRepo)
    {
        $this->mailingRepository = $mailingRepo;
        $this->SendMailHelper = new SendMailHelper();
    }

    public function index($id = null){
        $product = Product::find($id);

        $user = Auth::user();

        $stock_solicitado = 0;

        $attributes = array();
        foreach($product->entity->attributeValueEntities as $attributeValueEntity){
            array_push($attributes, $attributeValueEntity->attributeValue->attribute);
        }
        $attributes = array_unique(array_merge($attributes, $attributes), SORT_REGULAR);

        return view('product.product', array('product' => $product, 'attributes' => $attributes,
            'stock_solicitado' => $stock_solicitado, 'category' => $product->categoryProducts{0}->category,
            'seller' => (isset($product->categoryProducts{0}->category->sellerCategories{0}->seller) ? $product->categoryProducts{0}->category->sellerCategories{0}->seller : null)));
    }

    public function contact(CreateMailingRequest $request)
    {
        $product = Product::find($request->input('product_id'));

        $user = Auth::user();

        $stock_solicitado = 0;

        $attributes = array();
        foreach($product->entity->attributeValueEntities as $attributeValueEntity){
            array_push($attributes, $attributeValueEntity->attributeValue->attribute);
        }
        $attributes = array_unique(array_merge($attributes, $attributes), SORT_REGULAR);

        //Envio de mail:
        $input = $request->all();

        $mailing = $this->mailingRepository->create($input);

        $this->SendMailHelper->sendEmailContactUs($mailing);

        Flash::success('Consulta enviada.');

        return view('product.product', array('product' => $product, 'attributes' => $attributes,
            'stock_solicitado' => $stock_solicitado, 'category' => $product->categoryProducts{0}->category,
            'seller' => (isset($product->categoryProducts{0}->category->sellerCategories{0}->seller) ? $product->categoryProducts{0}->category->sellerCategories{0}->seller : null)));
    }

}
