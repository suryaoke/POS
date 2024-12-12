<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductImport implements ToModel, WithHeadingRow, WithMultipleSheets, SkipsEmptyRows
{
    public function sheets(): array
    {
        return [
            0 => $this
        ];
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Product([
            //

            'name' => $row['name'],
            'slug' => Product::generateUniqueSlug($row['name']),
            'category_id' => $row['category_id'],
            'stock' => $row['stock'],
            'price' => $row['price'],
            'is_active' => $row['is_active'],
            'barcode' => $row['barcode'],
            'image' => $row['image'],

        ]);
    }

    // public function rules(): array
    // {
    //     return [
    //         '*.name' => 'required|string',
    //         '*.category_id' => 'required|exists:categories.id',
    //         '*.stock' => 'required|integer|min:0',
    //         '*.price' => 'required|numeric:0',
    //         '*.barcode' => 'required|string|unique:products,barcode',
    //     ];
    // }
    // public function customValidationMessages()
    // {
    //     return [
    //         '*.name' => 'Kolom :attribute harus diisi',
    //         '*.category_id' => 'Kolom :attribute tidak valid',
    //         '*.stock' => 'Kolom :attribute harus angka',
    //         '*.price' => ' Kolom :attribute harus angka',
    //         '*.barcode' => ' Kolom :attribute sudah ada sebelumnya',
    //     ];
    // }
}
