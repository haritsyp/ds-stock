<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PurchaseOrderRequest;
use App\Models\PurchaseOrder;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;

/**
 * Class PurchaseOrderCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PurchaseOrderCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\PurchaseOrder::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/purchase-order');
        CRUD::setEntityNameStrings('purchase order', 'purchase orders');
        $this->crud->setEditView('page.purchase_order.edit');
        $this->crud->setCreateView('page.purchase_order.create');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('id');
        CRUD::column('supplier_id');
        CRUD::column('po_date');
        CRUD::column('po_number');
        CRUD::column('total');
        CRUD::column('discount');
        CRUD::column('shipping_amount');
        CRUD::column('additional_charge');
        CRUD::column('tax');
        CRUD::column('note');
        CRUD::column('created_at');
        CRUD::column('updated_at');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(PurchaseOrderRequest::class);
        $this->crud->setCreateContentClass("col-md-12");
        $this->crud->setUpdateContentClass("col-md-12");

        $statusNote = [
            'name' => 'status_html',
            'type' => 'custom_html',
            'value' => 'Status : <b style="color: green">' . ($this->crud->getCurrentEntry()->status ?? "Open") . '</b>'
        ];


        $this->crud->addFields([
            $statusNote,
            [
                'name' => 'po_number',
                'label' => "PO Number",
                'type' => 'text',
                'default' => IdGenerator::generate(['table' => 'purchase_orders', 'field' => 'po_number', 'length' => 20, 'prefix' => 'PO/' . date('ym') . '/']),
                'wrapper' => [
                    'class' => 'form-group col-md-6'
                ],
                'attributes' => [
                    'readonly' => 'readonly'
                ]
            ],
            [
                'name' => 'po_date',
                'type' => 'datetime_picker',
                'label' => 'Date',
                'datetime_picker_options' => [
                    'format' => 'DD/MM/YYYY',
                    'language' => 'en',
                ],
                'allows_null' => true,
                'wrapper' => [
                    'class' => 'form-group col-md-6'
                ],
                'attributes' => ['required' => 'required']
            ],
            [
                'label' => "Supplier",
                'type' => 'select2',
                'name' => 'supplier_id',
                'entity' => 'supplier',
                'model' => "App\Models\Supplier",
                'attributes' => ['required' => 'required'],
                'attribute' => 'full_name',
                'options' => (function ($query) {
                    return $query->orderBy('code', 'ASC')->get();
                }),
                'wrapper' => [
                    'class' => 'form-group col-md-6'
                ],
            ],
            [
                'name' => 'note',
                'type' => 'textarea',
                'label' => 'Note',
                'wrapper' => [
                    'class' => 'form-group col-md-6'
                ],
            ],
            [
                'name' => 'purchase_order_items',
                'label' => '',
                'type' => 'repeatable',
                'fields' => [
                    [
                        'label' => "Product",
                        'type' => 'select2',
                        'name' => 'product_id',
                        'entity' => 'purchase_order_item',
                        'model' => "App\Models\Product",
                        'attribute' => 'full_name',
                        'wrapper' => [
                            'class' => 'form-group col-md-3'
                        ],
                        'attributes' => ['required' => 'required']
                    ],
                    [
                        'name' => 'quantity',
                        'type' => 'number',
                        'label' => 'Quantity',
                        'wrapper' => ['class' => 'form-group col-md-2'],
                        'attributes' => ['required' => 'required']
                    ],
                    [
                        'name' => 'price',
                        'type' => 'number',
                        'label' => 'Price',
                        'wrapper' => ['class' => 'form-group col-md-2'],
                        'attributes' => ['required' => 'required']
                    ],
                    [
                        'name' => 'discount',
                        'type' => 'number',
                        'label' => 'Discount',
                        'wrapper' => ['class' => 'form-group col-md-2'],
                        'default' => 0
                    ],
                    [
                        'name' => 'note',
                        'type' => 'text',
                        'label' => 'Note',
                        'wrapper' => ['class' => 'form-group col-md-3']
                    ]

                ],
                'tab' => 'Items',
                'new_item_label' => 'Add Item', // customize the text of the button
                'init_rows' => 1, // number of empty rows to be initialized, by default 1
                'min_rows' => 1, // minimum rows allowed, when reached the "delete" buttons will be hidden
                'max_rows' => 100, // maximum rows allowed, when reached the "new item" button will be hidden

            ],
        ]);


        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    /**
     * Store a newly created resource in the database.
     *
     * @return array|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store()
    {
        $this->crud->hasAccessOrFail('create');

        // execute the FormRequest authorization and validation, if one is required
        $request = $this->crud->validateRequest();

        // insert item in the db
        $item = $this->crud->create($this->crud->getStrippedSaveRequest());
        $this->data['entry'] = $this->crud->entry = $item;

        // show a success message
        \Alert::success(trans('backpack::crud.insert_success'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();

        return $this->crud->performSaveAction($item->getKey());
    }

    public function cancel(Request $request)
    {
        dd('wewew');
    }
}
