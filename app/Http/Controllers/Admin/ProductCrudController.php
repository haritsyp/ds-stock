<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProductCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProductCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;

    //use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Product::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/product');
        CRUD::setEntityNameStrings('product', 'products');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {

        CRUD::addColumns([
            [
                'name' => 'sku',
                'label' => 'SKU',
                'type' => 'closure',
                'function' => function ($entry) {
                    return view('page.product.card-name', compact('entry'))->render();
                }
            ]
        ]);

        CRUD::column('barcode');

        CRUD::addColumns([
            [
                'name' => 'is_active',
                'label' => 'Active',
                'type' => 'boolean',
                'options' => [0 => 'Active', 1 => 'Inactive']
            ]
        ]);

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
        CRUD::setValidation(ProductRequest::class);
        $this->crud->setCreateContentClass("col-md-12");
        $this->crud->setUpdateContentClass("col-md-12");

        $this->crud->addFields([
            [
                'name' => 'is_active',
                'label' => "Active",
                'type' => 'select_from_array',
                'options' => ['0' => 'Disabled', '1' => 'Enabled'],
                'wrapper' => [
                    'class' => 'form-group col-md-6'
                ],
                'allows_null' => false,
                'tab' => 'General',
            ],
            [
                'label' => 'SKU',
                'type' => 'text',
                'name' => 'sku',
                'tab' => 'General',
                'wrapper' => [
                    'class' => 'form-group col-md-6'
                ],
            ],
            [
                'label' => 'Barcode',
                'type' => 'text',
                'name' => 'barcode',
                'tab' => 'General',
                'wrapper' => [
                    'class' => 'form-group col-md-6'
                ],
            ],
            [
                'label' => 'Name',
                'type' => 'text',
                'name' => 'name',
                'tab' => 'General',
                'wrapper' => [
                    'class' => 'form-group col-md-6'
                ],
            ],
            [    // Select2Multiple = n-n relationship (with pivot table)
                'label' => "Category",
                'type' => 'select2_multiple',
                'name' => 'categories', // the method that defines the relationship in your Model
                'entity' => 'categories', // the method that defines the relationship in your Model
                'model' => "App\Models\Category", // foreign key model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
                'tab' => 'General',
                'wrapper' => [
                    'class' => 'form-group col-md-6'
                ],
                'options' => (function ($query) {
                    return $query->orderBy('name', 'ASC')->get();
                }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
            ],
            [
                'label' => 'Regular Price',
                'type' => 'number',
                'name' => 'price',
                'tab' => 'General',
                'wrapper' => [
                    'class' => 'form-group col-md-6'
                ],
            ],
            [
                'label' => 'Special Price',
                'type' => 'number',
                'name' => 'special_price',
                'tab' => 'General',
                'hint' => 'used if you want to display the strike price',
                'wrapper' => [
                    'class' => 'form-group col-md-6'
                ],
            ],
            [
                'label' => 'Weight (gr)',
                'type' => 'number',
                'name' => 'weight',
                'tab' => 'General',
                'wrapper' => [
                    'class' => 'form-group col-md-3'
                ],
            ],
            [
                'label' => 'Width (cm)',
                'type' => 'number',
                'name' => 'width',
                'tab' => 'General',
                'wrapper' => [
                    'class' => 'form-group col-md-3'
                ],
            ],
            [
                'label' => 'Length (cm)',
                'type' => 'number',
                'name' => 'length',
                'tab' => 'General',
                'wrapper' => [
                    'class' => 'form-group col-md-3'
                ],
            ],
            [
                'label' => 'Height (cm)',
                'type' => 'number',
                'name' => 'height',
                'tab' => 'General',
                'wrapper' => [
                    'class' => 'form-group col-md-3'
                ],
            ],
            [
                'label' => 'Description',
                'type' => 'ckeditor',
                'name' => 'description',
                'tab' => 'General',
                'wrapper' => [
                    'class' => 'form-group col-md-12'
                ],
            ],
            [
                'label' => 'URL Key',
                'type' => 'text',
                'name' => 'url_key',
                'hint' => 'if blank, url key will be automatically generated based on the product name',
                'tab' => 'SEO',
                'wrapper' => [
                    'class' => 'form-group col-md-12'
                ],
            ],
            [
                'label' => 'Meta Title',
                'type' => 'text',
                'name' => 'meta_title',
                'tab' => 'SEO',
                'wrapper' => [
                    'class' => 'form-group col-md-12'
                ],
            ],
            [
                'label' => 'Meta Description',
                'type' => 'textarea',
                'name' => 'meta_description',
                'tab' => 'SEO',
                'wrapper' => [
                    'class' => 'form-group col-md-12'
                ],
            ]
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
}
