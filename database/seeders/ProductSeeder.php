<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => '休閒紓壓座墊躺椅',
            'category_id' => 1,
            'image_url' => 'https://storage.googleapis.com/vue-course-api.appspot.com/chimoochi%2F1596820731244.jpg?GoogleAccessId=firebase-adminsdk-zzty7%40vue-course-api.iam.gserviceaccount.com&Expires=1742169600&Signature=kjrgRwffGb2%2B9%2F4OFWJ8Z3hyVrb1JJeTqdT1AXdzaX9t19YDf%2Fs4wr%2FMm6d6jIpubEfBF5ympKqEFDjSmC6jS9DtiARXyfjMzaDPvDvhm55cTHyExxxkfRS6ZEm1vCZPSxuANbBjgzgwAHkGjvlXWU5YH4tsdElU3kZWBPRxzO98MmcOBAqJPT%2FE1HCDTXbLSVlkcioAoWPiBIyejp%2Bax6VQyLnWnYwhw325INXpX0eImeTuBAZoW%2BtG8ZgwJZuCa50XNtgRsvZRIx6CPnRdlCP0%2FRVVysvbSSDc87PpP%2Fs0cmCGVVJYXKRGMi6p%2BpgtR8N76yi9GVDPvsXbLfZAuQ%3D%3d',
            'origin_price' => '3700',
            'price' => '2775',
            'unit' => '張',
            'is_enabled' => true,
            'num' => 1,
        ]);

        Product::create([
            'name' => '編織風奢華座凳',
            'category_id' => 2,
            'image_url' => 'https://storage.googleapis.com/vue-course-api.appspot.com/chimoochi%2F1596820731244.jpg?GoogleAccessId=firebase-adminsdk-zzty7%40vue-course-api.iam.gserviceaccount.com&Expires=1742169600&Signature=kjrgRwffGb2%2B9%2F4OFWJ8Z3hyVrb1JJeTqdT1AXdzaX9t19YDf%2Fs4wr%2FMm6d6jIpubEfBF5ympKqEFDjSmC6jS9DtiARXyfjMzaDPvDvhm55cTHyExxxkfRS6ZEm1vCZPSxuANbBjgzgwAHkGjvlXWU5YH4tsdElU3kZWBPRxzO98MmcOBAqJPT%2FE1HCDTXbLSVlkcioAoWPiBIyejp%2Bax6VQyLnWnYwhw325INXpX0eImeTuBAZoW%2BtG8ZgwJZuCa50XNtgRsvZRIx6CPnRdlCP0%2FRVVysvbSSDc87PpP%2Fs0cmCGVVJYXKRGMi6p%2BpgtR8N76yi9GVDPvsXbLfZAuQ%3D%3d',
            'origin_price' => '3700',
            'price' => '2775',
            'unit' => '張',
            'is_enabled' => true,
            'num' => 1,
        ]);

        Product::create([
            'name' => '休閒紓壓座墊躺椅',
            'category_id' => 1,
            'image_url' => 'https://storage.googleapis.com/vue-course-api.appspot.com/chimoochi%2F1596820731244.jpg?GoogleAccessId=firebase-adminsdk-zzty7%40vue-course-api.iam.gserviceaccount.com&Expires=1742169600&Signature=kjrgRwffGb2%2B9%2F4OFWJ8Z3hyVrb1JJeTqdT1AXdzaX9t19YDf%2Fs4wr%2FMm6d6jIpubEfBF5ympKqEFDjSmC6jS9DtiARXyfjMzaDPvDvhm55cTHyExxxkfRS6ZEm1vCZPSxuANbBjgzgwAHkGjvlXWU5YH4tsdElU3kZWBPRxzO98MmcOBAqJPT%2FE1HCDTXbLSVlkcioAoWPiBIyejp%2Bax6VQyLnWnYwhw325INXpX0eImeTuBAZoW%2BtG8ZgwJZuCa50XNtgRsvZRIx6CPnRdlCP0%2FRVVysvbSSDc87PpP%2Fs0cmCGVVJYXKRGMi6p%2BpgtR8N76yi9GVDPvsXbLfZAuQ%3D%3d',
            'origin_price' => '3700',
            'price' => '2775',
            'unit' => '張',
            'is_enabled' => true,
            'num' => 1,
        ]);

        Product::create([
            'name' => '休閒紓壓座墊躺椅',
            'category_id' => 1,
            'image_url' => 'https://storage.googleapis.com/vue-course-api.appspot.com/chimoochi%2F1596820731244.jpg?GoogleAccessId=firebase-adminsdk-zzty7%40vue-course-api.iam.gserviceaccount.com&Expires=1742169600&Signature=kjrgRwffGb2%2B9%2F4OFWJ8Z3hyVrb1JJeTqdT1AXdzaX9t19YDf%2Fs4wr%2FMm6d6jIpubEfBF5ympKqEFDjSmC6jS9DtiARXyfjMzaDPvDvhm55cTHyExxxkfRS6ZEm1vCZPSxuANbBjgzgwAHkGjvlXWU5YH4tsdElU3kZWBPRxzO98MmcOBAqJPT%2FE1HCDTXbLSVlkcioAoWPiBIyejp%2Bax6VQyLnWnYwhw325INXpX0eImeTuBAZoW%2BtG8ZgwJZuCa50XNtgRsvZRIx6CPnRdlCP0%2FRVVysvbSSDc87PpP%2Fs0cmCGVVJYXKRGMi6p%2BpgtR8N76yi9GVDPvsXbLfZAuQ%3D%3d',
            'origin_price' => '3700',
            'price' => '2775',
            'unit' => '張',
            'is_enabled' => true,
            'num' => 1,
        ]);

        Product::create([
            'name' => '休閒紓壓座墊躺椅',
            'category_id' => 1,
            'image_url' => 'https://storage.googleapis.com/vue-course-api.appspot.com/chimoochi%2F1596820731244.jpg?GoogleAccessId=firebase-adminsdk-zzty7%40vue-course-api.iam.gserviceaccount.com&Expires=1742169600&Signature=kjrgRwffGb2%2B9%2F4OFWJ8Z3hyVrb1JJeTqdT1AXdzaX9t19YDf%2Fs4wr%2FMm6d6jIpubEfBF5ympKqEFDjSmC6jS9DtiARXyfjMzaDPvDvhm55cTHyExxxkfRS6ZEm1vCZPSxuANbBjgzgwAHkGjvlXWU5YH4tsdElU3kZWBPRxzO98MmcOBAqJPT%2FE1HCDTXbLSVlkcioAoWPiBIyejp%2Bax6VQyLnWnYwhw325INXpX0eImeTuBAZoW%2BtG8ZgwJZuCa50XNtgRsvZRIx6CPnRdlCP0%2FRVVysvbSSDc87PpP%2Fs0cmCGVVJYXKRGMi6p%2BpgtR8N76yi9GVDPvsXbLfZAuQ%3D%3d',
            'origin_price' => '3700',
            'price' => '2775',
            'unit' => '張',
            'is_enabled' => true,
            'num' => 1,
        ]);

        Product::create([
            'name' => '休閒紓壓座墊躺椅',
            'category_id' => 1,
            'image_url' => 'https://storage.googleapis.com/vue-course-api.appspot.com/chimoochi%2F1596820731244.jpg?GoogleAccessId=firebase-adminsdk-zzty7%40vue-course-api.iam.gserviceaccount.com&Expires=1742169600&Signature=kjrgRwffGb2%2B9%2F4OFWJ8Z3hyVrb1JJeTqdT1AXdzaX9t19YDf%2Fs4wr%2FMm6d6jIpubEfBF5ympKqEFDjSmC6jS9DtiARXyfjMzaDPvDvhm55cTHyExxxkfRS6ZEm1vCZPSxuANbBjgzgwAHkGjvlXWU5YH4tsdElU3kZWBPRxzO98MmcOBAqJPT%2FE1HCDTXbLSVlkcioAoWPiBIyejp%2Bax6VQyLnWnYwhw325INXpX0eImeTuBAZoW%2BtG8ZgwJZuCa50XNtgRsvZRIx6CPnRdlCP0%2FRVVysvbSSDc87PpP%2Fs0cmCGVVJYXKRGMi6p%2BpgtR8N76yi9GVDPvsXbLfZAuQ%3D%3d',
            'origin_price' => '3700',
            'price' => '2775',
            'unit' => '張',
            'is_enabled' => true,
            'num' => 1,
        ]);

        Product::create([
            'name' => '休閒紓壓座墊躺椅',
            'category_id' => 1,
            'image_url' => 'https://storage.googleapis.com/vue-course-api.appspot.com/chimoochi%2F1596820731244.jpg?GoogleAccessId=firebase-adminsdk-zzty7%40vue-course-api.iam.gserviceaccount.com&Expires=1742169600&Signature=kjrgRwffGb2%2B9%2F4OFWJ8Z3hyVrb1JJeTqdT1AXdzaX9t19YDf%2Fs4wr%2FMm6d6jIpubEfBF5ympKqEFDjSmC6jS9DtiARXyfjMzaDPvDvhm55cTHyExxxkfRS6ZEm1vCZPSxuANbBjgzgwAHkGjvlXWU5YH4tsdElU3kZWBPRxzO98MmcOBAqJPT%2FE1HCDTXbLSVlkcioAoWPiBIyejp%2Bax6VQyLnWnYwhw325INXpX0eImeTuBAZoW%2BtG8ZgwJZuCa50XNtgRsvZRIx6CPnRdlCP0%2FRVVysvbSSDc87PpP%2Fs0cmCGVVJYXKRGMi6p%2BpgtR8N76yi9GVDPvsXbLfZAuQ%3D%3d',
            'origin_price' => '3700',
            'price' => '2775',
            'unit' => '張',
            'is_enabled' => true,
            'num' => 1,
        ]);
    }
}
