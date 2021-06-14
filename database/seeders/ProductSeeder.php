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
            "id" => 1,
            "category_id" => 1,
            "desc" => "皮製經典復古沙發，是由多位大師級的工匠和設計師，經過不容妥協的選材和設計，再經由專家嚴格的多項耐用性和安全性的測試，聯手打造出兼具尊爵的視覺饗宴以及最高等級的使用體驗的產品。",
            "image_url" => "https://storage.googleapis.com/vue-course-api.appspot.com/chimoochi%2F1596820731244.jpg?GoogleAccessId=firebase-adminsdk-zzty7%40vue-course-api.iam.gserviceaccount.com&Expires=1742169600&Signature=kjrgRwffGb2%2B9%2F4OFWJ8Z3hyVrb1JJeTqdT1AXdzaX9t19YDf%2Fs4wr%2FMm6d6jIpubEfBF5ympKqEFDjSmC6jS9DtiARXyfjMzaDPvDvhm55cTHyExxxkfRS6ZEm1vCZPSxuANbBjgzgwAHkGjvlXWU5YH4tsdElU3kZWBPRxzO98MmcOBAqJPT%2FE1HCDTXbLSVlkcioAoWPiBIyejp%2Bax6VQyLnWnYwhw325INXpX0eImeTuBAZoW%2BtG8ZgwJZuCa50XNtgRsvZRIx6CPnRdlCP0%2FRVVysvbSSDc87PpP%2Fs0cmCGVVJYXKRGMi6p%2BpgtR8N76yi9GVDPvsXbLfZAuQ%3D%3D",
            "is_enabled" => true,
            "origin_price" => 3700,
            "price" => 2775,
            "name" => "休閒紓壓座墊躺椅",
            "unit" => "張",
            "quantity" => 1
        ]);

        Product::create([
            "id" => 2,
            "category_id" => 2,
            "desc" => "皮製經典復古沙發，是由多位大師級的工匠和設計師，經過不容妥協的選材和設計，再經由專家嚴格的多項耐用性和安全性的測試，聯手打造出兼具尊爵的視覺饗宴以及最高等級的使用體驗的產品。",
            "image_url" => "https://storage.googleapis.com/vue-course-api.appspot.com/chimoochi%2F1596820212399.jpg?GoogleAccessId=firebase-adminsdk-zzty7%40vue-course-api.iam.gserviceaccount.com&Expires=1742169600&Signature=gGPhLjZJyME5WXsUDtG%2FamKcqgwhMjg87h%2BmMHcEw5BsBT8sI8%2BZLDB8rGMUjUc3FVvPBu7HxZm%2Fgtef3Lbfzn71HAbtLgNp33dF2bb5ef2QSa77XyLZqp6yyhltCaswCMmaZuhlnV0eAfcK2Naf9oRj8N%2FKFMWrgXRO7%2B4WlbNVmoaIVlCMyrc62vgM%2FswqZiIpQyp%2BJcVFqfyELA0DuRThjAif21cGgPY4JfIcWkembFDvHqiQybAbxTU3xJ%2FWmZCn9qgaVQAuEvTpkZakYuTc0PDZq%2FNwdzTn7b5dJcIMMCY7DssupIN5j9e%2F9CoF%2FHkfkeVe5P6pwj6B6VS%2FNw%3D%3D",
            "is_enabled" => true,
            "origin_price" => 1200,
            "price" => 900,
            "name" => "編織風奢華座凳",
            "unit" => "張",
            "quantity" => 2
        ]);

        Product::create([
            "id" => 3,
            "category_id" => 3,
            "desc" => "皮製經典復古沙發，是由多位大師級的工匠和設計師，經過不容妥協的選材和設計，再經由專家嚴格的多項耐用性和安全性的測試，聯手打造出兼具尊爵的視覺饗宴以及最高等級的使用體驗的產品。",
            "image_url" => "https://storage.googleapis.com/vue-course-api.appspot.com/chimoochi%2F1596819554983.jpg?GoogleAccessId=firebase-adminsdk-zzty7%40vue-course-api.iam.gserviceaccount.com&Expires=1742169600&Signature=k42pEecFNMEvde3OXimwYy6ARqqcuG5KCq0JYvCDJoYrGXgyrgVtwyQNLXLq1KE%2FYKbVWbyqHXFq8wp72z%2BhHTklYoIQj425qz8mEwETuM96PgRhjl2yDJbV3NKvlpNgbzBtldN7lE%2Bx4iRRZFly%2BQVf%2BIxna19ztflbHDy4JsPrpO2mDHrDq2jdeKIMmUVwJq2EkK%2F7%2B3W47qCe%2BVSi8yJ0cau3jcdl5VtnvzY2zmf3iv1hNaSEUDT61bUaZ5paJVVYpf%2BBOIM2%2FPUH%2BECoqZt9l369zY0ZHc3iSj8xTNmdAHhtQVb0b5K11v%2Bz2CAS%2FT9x2Nth3MO0WXDIc58ESg%3D%3D",
            "is_enabled" => true,
            "origin_price" => 7800,
            "price" => 5850,
            "name" => "現代風質感單人沙發椅",
            "unit" => "張",
            "quantity" => 3
        ]);

        Product::create([
            "id" => 4,
            "category_id" => 3,
            "desc" => "皮製經典復古沙發，是由多位大師級的工匠和設計師，經過不容妥協的選材和設計，再經由專家嚴格的多項耐用性和安全性的測試，聯手打造出兼具尊爵的視覺饗宴以及最高等級的使用體驗的產品。",
            "image_url" => "https://storage.googleapis.com/vue-course-api.appspot.com/chimoochi%2F1596818340395.jpg?GoogleAccessId=firebase-adminsdk-zzty7%40vue-course-api.iam.gserviceaccount.com&Expires=1742169600&Signature=qOiD98jUMlCy0N3nxwQ7Kp3JC9NMdmfw%2BsT3%2BPnCsvVR1wnOMh94suYCJGxVEigDI5znNIuZ2AaAjm27g6TV2bh76KNwRzHbXRjpp31exV8PFRx20vBuxTEnp6Owp7w7yO562rDYG8IuDo12YjdnFWzjDgcRfMVnehcFDQLFelv33FHxKz4fPYOaz0idGC0esez9eXZlqBAuhzc7e9y8wTK1bQsf0JHD8PijP%2BAKofS65FKNHEOGr2widEch3jX7rOgrDUOOhsPUDWzIkrhfZWDXuMapzFIlxAKtQGAXHo4vFrbkhrIcy17CpOTNjMGV6b7g7j85rp0PlyRUsG1zqQ%3D%3D",
            "is_enabled" => false,
            "origin_price" => 7000,
            "price" => 5250,
            "name" => "雅致皮革單人沙發",
            "unit" => "張",
            "quantity" => 4
        ]);

        Product::create([
            "id" => 5,
            "category_id" => 3,
            "desc" => "皮製經典復古沙發，是由多位大師級的工匠和設計師，經過不容妥協的選材和設計，再經由專家嚴格的多項耐用性和安全性的測試，聯手打造出兼具尊爵的視覺饗宴以及最高等級的使用體驗的產品。",
            "image_url" => "https://storage.googleapis.com/vue-course-api.appspot.com/chimoochi%2F1596815371385.jpg?GoogleAccessId=firebase-adminsdk-zzty7%40vue-course-api.iam.gserviceaccount.com&Expires=1742169600&Signature=me1aO4Lf4%2BwEZuqFY4PgJdFp1Qlewd9ET1u6ffL%2Fq22%2Bo%2FDFqI63vu8%2BlBZXNUC2lKDHMWfDM4popqiB8%2BObmmP8kgbpJ68HS82XOujE%2FldLuXZwHHvB%2BlV79OhxByGlCRPCrXcM93KTnQG3LtP3gMTTjuX%2F73ymE2LUbVmW8x7Wcm%2FegFGyEIpKXtBAXbCphoFgNJ2X%2FQRDG7RHOpWpbQr%2BM8FiM59srtKCMmuwnZnsaY%2FM7Om1%2BFSA9vS03QZiLioV7Qf2%2B8MsprTIt72niMm4ofMa7fGB50hk7IG6dkH0A%2F2Wiv9uTEVMoNK34DAFWkRJr2GGwmfOnKfJHflwdA%3D%3D",
            "is_enabled" => true,
            "origin_price" => 12000,
            "price" => 9000,
            "name" => "布面質感素面沙發",
            "unit" => "組",
            "quantity" => 5
        ]);

        Product::create([
            "id" => 6,
            "category_id" => 3,
            "desc" => "皮製經典復古沙發，是由多位大師級的工匠和設計師，經過不容妥協的選材和設計，再經由專家嚴格的多項耐用性和安全性的測試，聯手打造出兼具尊爵的視覺饗宴以及最高等級的使用體驗的產品。",
            "image_url" => "https://storage.googleapis.com/vue-course-api.appspot.com/chimoochi%2F1596815255430.jpg?GoogleAccessId=firebase-adminsdk-zzty7%40vue-course-api.iam.gserviceaccount.com&Expires=1742169600&Signature=PR3%2F5STci%2Btt%2FsBdbutqXqV90KPF%2BqY0TLV3K%2B1IBxzPW0rSpsES%2B87kX1bCSPm7WGx%2Be4snmrjCPPVd9TBDeuNuqk2RSoCTrztpckTRK0MQ6UEM7O82%2F6FVUxKkV3ISMzt9IL2SDBdvqd1499c0%2BKvZp64O6DGr13FCVNwWWU1J71Rwv1pLhBxd4T%2Bdt9URgcNZLBD8dm3R%2FCOMhZnFs7EMJKbYOxOhIq2nDfaTl24MCL0bH4YFtPM1bVyZvmLk2ZCK2jyJtuoGvCzc8bFgUT7c0KjtJVXVM%2Fma%2BvmtpL7gfAPzF4o3Zz%2F41GNWwXf00ywKB8GFPPkApLsuOUst%2BA%3D%3D",
            "is_enabled" => false,
            "origin_price" => 10000,
            "price" => 7500,
            "name" => "素面皮革雙人沙發",
            "unit" => "張",
            "quantity" => 6
        ]);

        Product::create([
            "id" => 7,
            "category_id" => 1,
            "desc" => "皮製經典復古沙發，是由多位大師級的工匠和設計師，經過不容妥協的選材和設計，再經由專家嚴格的多項耐用性和安全性的測試，聯手打造出兼具尊爵的視覺饗宴以及最高等級的使用體驗的產品。",
            "image_url" => "https://storage.googleapis.com/vue-course-api.appspot.com/chimoochi%2F1596814093332.jpg?GoogleAccessId=firebase-adminsdk-zzty7%40vue-course-api.iam.gserviceaccount.com&Expires=1742169600&Signature=kuQOKwkT09otz506AbxZSVM5e6KRaEXEjP4%2BAITpc2B74CN4wQr1FXrlH5%2B8Mcm%2BYmLbhhoeO%2Bx7l6Bk%2B%2BS3JXsXBRINZrlxyXVxBpNyA8gNcYo6K57py8L8B2uNsuc5%2FPdnfQK3VeMWgDiiCvt1x4RJ6nxOPMmBIK5yIH5QSMp4eOYAwxoUY4KOelG6EqJn893PUvA1RIQEmrQtw9gODUZK4%2FCDzGP%2FY2rx7IJjaUMSEAXMHBvKaO2S1o1LmSalYQHPjUDpSI3PGQOdYJ4XrfIRSePhjt%2F4bU5W%2F1ZaLXgTQc5Uy6PNv%2FSBO6KZlCHwHQsNRgCkXpbcugwvdpxYQA%3D%3D",
            "is_enabled" => true,
            "origin_price" => 800,
            "price" => 600,
            "name" => "實木質感餐椅",
            "unit" => "張",
            "quantity" => 7
        ]);

        Product::create([
            "id" => 8,
            "category_id" => 5,
            "desc" => "皮製經典復古沙發，是由多位大師級的工匠和設計師，經過不容妥協的選材和設計，再經由專家嚴格的多項耐用性和安全性的測試，聯手打造出兼具尊爵的視覺饗宴以及最高等級的使用體驗的產品。",
            "image_url" => "https://storage.googleapis.com/vue-course-api.appspot.com/chimoochi%2F1596813434622.jpg?GoogleAccessId=firebase-adminsdk-zzty7%40vue-course-api.iam.gserviceaccount.com&Expires=1742169600&Signature=oS3acO1YeteT%2BcPXSH6JV105TNOasLI5QfViTTbvrAB9JHiVTTo%2F3yqADpqu1dGynkgPnBi%2B6AS6DXIzZ5LbTsWTdUIfJVXmN%2F9tCEWLj6HrwcH7yJtdy5J9a%2FVFM9m2lnFyuc9ewJ1hq9y4NbnHJekAUfmLjBB9CMWoGvFyaPpo8VoOh1lgQxoTVa3zSpwkhHs8cu04lanS8zIGpftJaivVAXlvBOI9gyozKJzN1P6VRmpR2V0F2RX4QU2bRv9VCKF9IsfZmvr0KEXuvCj9QXd%2F8n2gUycGKNiGwEXyFv39C%2F78TaxpkPfOn%2B%2FPfFZm%2F%2FmU7005I3J5zUAIiyTnZA%3D%3D",
            "is_enabled" => true,
            "origin_price" => 600,
            "price" => 450,
            "name" => "極致線條風格椅",
            "unit" => "張",
            "quantity" => 8
        ]);

        Product::create([
            "id" => 9,
            "category_id" => 1,
            "desc" => "皮製經典復古沙發，是由多位大師級的工匠和設計師，經過不容妥協的選材和設計，再經由專家嚴格的多項耐用性和安全性的測試，聯手打造出兼具尊爵的視覺饗宴以及最高等級的使用體驗的產品。",
            "image_url" => "https://storage.googleapis.com/vue-course-api.appspot.com/chimoochi%2F1596809877826.jpg?GoogleAccessId=firebase-adminsdk-zzty7%40vue-course-api.iam.gserviceaccount.com&Expires=1742169600&Signature=pvM0jGbS3fKMNOLA%2Fh07d9x7bw%2Bc%2BMU2AaB4ctmJUWM441xNd9khWbPHRlp1Pvayzc%2B2kZ07HvkAUvGrB%2FR1NkvQFZs0R%2B%2FEXHWw%2BHhRhR5J9c9tMjsMXdi%2FUzuAILjdQ%2BqP2%2BQyaYddQw7VYXaj%2B%2BUuAYyZHx77hIyzVd8aWqg0aRFqeMhbtOmrwVaogIQA84zcGLfsM4r%2F1ZxEgRGuY%2FIJDfbOmxYGU6hod3ch9IGLjCkTf2nW6pdLEzOpADViQwi8jo4%2Fz4%2Fzfz5AeRBklI39qxAp4IyQ6ExW2B1PY5ut1nmYi2K%2BMWjqWfSVe9FlmdJXf8l3yAiNSabc0RDE5w%3D%3D",
            "is_enabled" => true,
            "origin_price" => 800,
            "price" => 600,
            "name" => "全實木簡約矮凳",
            "unit" => "張",
            "quantity" => 9
        ]);

        Product::create([
            "id" => 10,
            "category_id" => 6,
            "desc" => "皮製經典復古沙發，是由多位大師級的工匠和設計師，經過不容妥協的選材和設計，再經由專家嚴格的多項耐用性和安全性的測試，聯手打造出兼具尊爵的視覺饗宴以及最高等級的使用體驗的產品。",
            "image_url" => "https://storage.googleapis.com/vue-course-api.appspot.com/chimoochi%2F1596809251480.jpg?GoogleAccessId=firebase-adminsdk-zzty7%40vue-course-api.iam.gserviceaccount.com&Expires=1742169600&Signature=NmprMdrz8B8fZHHjFkeUFgYAaVpwX2m32UzfwvNyHXFh5XvmG7Xq4BRdN%2BXKrWY%2Fmk2f2DU0%2FF0AIvbQfdciw1Y3FGGlNtxZ19UhEnk2iWq2OuiewjQ2GXFBrlCWKk5H4%2FH9n3m7r7LUIbSsuwjbDhnOXczUM3An4dx0D8S1JtreCwsg6CzAiRCrh9P%2FOZ4F9hx9Y9KHOylWLBvL0XXKq%2FrjPcTldfRuHbn9hZTV37WEE2WRy6OGW0I6NwbyVfRaix%2FXQpw%2BiI3mqe%2BuzPJFxDH5Ig4r0F%2BPki0ryKq4yajKuK%2FNaLXbVjeYDWpwsu2FN%2BlfhcPct%2FZqmeRhCWuy8Q%3D%3D",
            "is_enabled" => true,
            "origin_price" => 1300,
            "price" => 975,
            "name" => "實木多功能高腳椅",
            "unit" => "張",
            "quantity" => 10
        ]);

        Product::create([
            "id" => 11,
            "category_id" => 4,
            "desc" => "皮製經典復古沙發，是由多位大師級的工匠和設計師，經過不容妥協的選材和設計，再經由專家嚴格的多項耐用性和安全性的測試，聯手打造出兼具尊爵的視覺饗宴以及最高等級的使用體驗的產品。",
            "image_url" => "https://storage.googleapis.com/vue-course-api.appspot.com/chimoochi%2F1595501640842.jpg?GoogleAccessId=firebase-adminsdk-zzty7%40vue-course-api.iam.gserviceaccount.com&Expires=1742169600&Signature=SMjni9ETzkBjpNrlp%2Fs9q2NnAeKlsT%2F1VtVAUtzeQzrzEvJQf6Hdb%2FBtFqkdL%2FqM3Lv3eTlHPXHaQG6eSJFex4BccXjCRqIwl9XKppfkd0rV2tzBfPllCxdlFChVuozbXClScNz1XzhggG%2BYBGobe8JgUBfse8RwOSrDwPHTFKTRuUNB6SuLSn%2F3JzYYGhqSXSilU%2BlVAY3jsgQrlkEfAQZeqw8WN6CVXx1DH9lbxKNhhQ03rLcKj%2F6oigZFO9J%2FvxeQBocmhOnu5qrPkDycH3%2FW7C1QfM01Z9Tn2YJsxBmqN5ZlnZCjDPDY4nW9igm5Hy1nRYu4ZFC4q7lrozjGxw%3D%3D",
            "is_enabled" => true,
            "origin_price" => 1500,
            "price" => 999,
            "name" => "工業風輕巧長椅",
            "unit" => "張",
            "quantity" => 3
        ]);

        Product::create([
            "id" => 12,
            "category_id" => 1,
            "desc" => "皮製經典復古沙發，是由多位大師級的工匠和設計師，經過不容妥協的選材和設計，再經由專家嚴格的多項耐用性和安全性的測試，聯手打造出兼具尊爵的視覺饗宴以及最高等級的使用體驗的產品。",
            "image_url" => "https://storage.googleapis.com/vue-course-api.appspot.com/chimoochi%2F1595923706888.jpg?GoogleAccessId=firebase-adminsdk-zzty7%40vue-course-api.iam.gserviceaccount.com&Expires=1742169600&Signature=L7Lh5iJ2pO%2BPNaFDRtJWiyrQKv82atZdntsKiQZ0k2y9rpTq44Pynz4qT5MT2%2B5QhPyb07LQQMOAOYaSy5ZSv7PFB9I2Un2PwcxYhbNoFcVVo7dhsC5CThX2aqciIASYIaSfhMbeMSAqCF%2BWOYXWRF5EbV%2FxWwLbtXVdI1ZPGxveqwuInl0thtHJbN2j0gJOCzplBTvMCMUjAuDQ3C3MEILz7RfUEvte2RkMKSsrJ2tlBVRA8R4DmI3fxzhWpcBfB5psh%2F3okQH1eSRUaxdYS%2B0iqD%2FDuO3Sz5x8yjmCNmgiHFfWf9GchhkIlfDsyg%2FNJAXXe%2Fhh2faml4rEOFM2pw%3D%3D",
            "is_enabled" => true,
            "origin_price" => 2700,
            "price" => 2025,
            "name" => "簡約木質坐墊椅",
            "unit" => "張",
            "quantity" => 6
        ]);

        Product::create([
            "id" => 13,
            "category_id" => 1,
            "desc" => "皮製經典復古沙發，是由多位大師級的工匠和設計師，經過不容妥協的選材和設計，再經由專家嚴格的多項耐用性和安全性的測試，聯手打造出兼具尊爵的視覺饗宴以及最高等級的使用體驗的產品。",
            "image_url" => "https://storage.googleapis.com/vue-course-api.appspot.com/chimoochi%2F1596126002028.jpg?GoogleAccessId=firebase-adminsdk-zzty7%40vue-course-api.iam.gserviceaccount.com&Expires=1742169600&Signature=isHIXWSZYI%2Fn2%2Fw9TUmdBqu7TK%2BHTl4%2FKmBAFZtJXRP%2FacgRJ9aKZOeksN2r6m6wdD6YuDhy2ViTYIedd3R9GqaNXFSnTWotVmuA2dFipWDZbzcpNvDV5N8swMOSuzSUhnVIrv9ASBi%2FpIedGDOu7ndgr3px9QYeXSICZaRH9jkxvBXTruXCAxGPrezLy4cdC4xcepvceXtppXHCtoY77%2FLi2ncE0i9WJaSwg8hs1If263uOhLlNOYYvC4B%2FEiIWPr9KIilXsJVCp0XBpIK1fJTG2QUrgKNFN7P%2BMeKwk9215htEg3SlBXscwfL2h2uv7Wrvrbjx31NwH3Gpho6cHA%3D%3D",
            "is_enabled" => true,
            "origin_price" => 1600,
            "price" => 1301,
            "name" => "經典淺背質感木椅",
            "unit" => "張",
            "quantity" => 4
        ]);

        Product::create([
            "id" => 14,
            "category_id" => 6,
            "desc" => "皮製經典復古沙發，是由多位大師級的工匠和設計師，經過不容妥協的選材和設計，再經由專家嚴格的多項耐用性和安全性的測試，聯手打造出兼具尊爵的視覺饗宴以及最高等級的使用體驗的產品。",
            "image_url" => "https://storage.googleapis.com/vue-course-api.appspot.com/chimoochi%2F1596127337438.jpg?GoogleAccessId=firebase-adminsdk-zzty7%40vue-course-api.iam.gserviceaccount.com&Expires=1742169600&Signature=RfspnUm6WlNwT8Ycd2JPtECbQOB4JoLZ4dWhnTVPtbWi%2Fsfr13XunfPGAVBkOo63NrYw325TitORW6hXP2Xozu3rEghyW4hX1TZ5w6bVJJJRBhpfET7EZx0wPKIGYErEScc3e09oTCvcSVu7Rxr3p5fGuULEWx37BbYYB2H85dl9ozlImXCdEWP5wBSPomG1QUmdyHo7t6LJ1EfsDOJ%2BeJ7QrAaUWVjQjuRblwHm99X%2F9gVUp4b5MnkV1AMMtV%2Fag9KObhUZcl8MjoJSCJqH1vI1lH1quPPGMvERgiRtVJczPkbsJW%2FsaDPrlZXIefGII72QCUzdrMkrgSMPyqJ%2BZg%3D%3D",
            "is_enabled" => true,
            "origin_price" => 3500,
            "price" => 2625,
            "name" => "尊爵曜石黑伊姆斯椅",
            "unit" => "張",
            "quantity" => 2
        ]);

        Product::create([
            "id" => 15,
            "category_id" => 6,
            "desc" => "皮製經典復古沙發，是由多位大師級的工匠和設計師，經過不容妥協的選材和設計，再經由專家嚴格的多項耐用性和安全性的測試，聯手打造出兼具尊爵的視覺饗宴以及最高等級的使用體驗的產品。",
            "image_url" => "https://storage.googleapis.com/vue-course-api.appspot.com/chimoochi%2F1596357342341.jpg?GoogleAccessId=firebase-adminsdk-zzty7%40vue-course-api.iam.gserviceaccount.com&Expires=1742169600&Signature=qN%2BB5mVqdM9da8DttlbkNw%2BirHZRfJ5DJq9U7CGNiD87CwbmkEFsw7hjhgo6ykFYE%2FTjJaAZIP5ISNF2XkkoJFgDIXTpmnjMMvbtIudakS5q6ogEnVAwLpOXvVBognmKa6La7cMJD0F9%2BEIrisA0A7aJuQ7kwXeW1IjdPq95OeOf%2FB31ZYfznkhCs%2BHbBGv1zV2%2FLHeJcxgpWlTGrboAylGvsJsGTLxlS8yMnuavD0CFEcEfAk7axywLTjqJJ5tCL3IEXlc4%2FDTlLTDLTJiNj3NAcGyafeGn9Bi1ehBsVvi7NUVHqsmdVuDYASJPYJc928NO3mjncst1gv8sorh0KA%3D%3D",
            "is_enabled" => true,
            "origin_price" => 4800,
            "price" => 3600,
            "name" => "繽紛質感單人座椅",
            "unit" => "張",
            "quantity" => 3
        ]);

        Product::create([
            "id" => 16,
            "category_id" => 4,
            "desc" => "皮製經典復古沙發，是由多位大師級的工匠和設計師，經過不容妥協的選材和設計，再經由專家嚴格的多項耐用性和安全性的測試，聯手打造出兼具尊爵的視覺饗宴以及最高等級的使用體驗的產品。",
            "image_url" => "https://storage.googleapis.com/vue-course-api.appspot.com/chimoochi%2F1596806270634.jpg?GoogleAccessId=firebase-adminsdk-zzty7%40vue-course-api.iam.gserviceaccount.com&Expires=1742169600&Signature=odphSoEbwH1On3hvIil8v7YmXWW1qzh%2Fx3mX0Min2J95YOEVd8PX5HGUMxXzcsYfb%2B3xDGndnijknyFiQgJlkFSdlGAar77INZwPO7mHzE3H0%2F2Xv6MZMwW4VbAtlaD1l%2FSvm1fjgzVMeWeW1Tv9DO3uT%2B68DQgg2ZK6AoFXrQ4CFbAtKzlqVDy8UOheMfFvhsa8dUcVsz9yRp%2BAUnhyuUq7P1NIGN4D%2Fd8HFh0n%2F5viaMrtJthTFPEIXjLGeMoFkfxqpDhSLPtjP7fqzKDDSVS9GcHRprL%2FtXXFYxezqtCUyARzP8KsLCkzJkfjLYq4cw4MTjyrS%2F88eOL94qvkmw%3D%3D",
            "is_enabled" => true,
            "origin_price" => 2500,
            "price" => 1875,
            "name" => "休閒紓壓座墊躺椅",
            "unit" => "張",
            "quantity" => 6
        ]);

        Product::create([
            "id" => 17,
            "category_id" => 5,
            "desc" => "皮製經典復古沙發，是由多位大師級的工匠和設計師，經過不容妥協的選材和設計，再經由專家嚴格的多項耐用性和安全性的測試，聯手打造出兼具尊爵的視覺饗宴以及最高等級的使用體驗的產品。",
            "image_url" => "https://storage.googleapis.com/vue-course-api.appspot.com/chimoochi%2F1596805162349.jpg?GoogleAccessId=firebase-adminsdk-zzty7%40vue-course-api.iam.gserviceaccount.com&Expires=1742169600&Signature=HS54pmghcJHBJRx9uIRuX7lhE%2Fq3I11FG0gVgc8hvh%2BADa1U1zpYHNnxogw2jBAEDhqeYYIKYQBUxzH2xhYAjO4D%2Bvc2Oz3T5d0foaJV3O0rBLFgS%2BScxsBi9DSpZs22oH3XqWXDPc7pgwna7Pu0fx3aeFlgLCgxeyBCeLMVq3sp35pYEgPPd3elNUUyfZxmGKJm2qX6bcZV1FewDhco8E%2Fww%2F9niTeMOLMLHCSOnjfmfSZC4HX3RJFP74uEZ2ZoTsHpP7JeWNanNeLx6HubGvYsF%2FOKlwobTdfDGYDaixDLcv67%2F9WVjNhjwwgHtIdu3oSfxLretTW%2BK5gwL53Qcw%3D%3D",
            "is_enabled" => true,
            "origin_price" => 2000,
            "price" => 1500,
            "name" => "方塊時尚風格座椅",
            "unit" => "張",
            "quantity" => 8
        ]);

        Product::create([
            "id" => 18,
            "category_id" => 5,
            "desc" => "皮製經典復古沙發，是由多位大師級的工匠和設計師，經過不容妥協的選材和設計，再經由專家嚴格的多項耐用性和安全性的測試，聯手打造出兼具尊爵的視覺饗宴以及最高等級的使用體驗的產品。",
            "image_url" => "https://storage.googleapis.com/vue-course-api.appspot.com/chimoochi%2F1596805817199.jpg?GoogleAccessId=firebase-adminsdk-zzty7%40vue-course-api.iam.gserviceaccount.com&Expires=1742169600&Signature=KUVnMZRCZuKKcWixZVpxPcq93MwiY2LSvEdlsYRJ5cf7bZm83U6et1ZB1wv1IniK43VHsTiXTvxGm5bsG00JCEav4NZJgPYcaUPvp%2FNaIxyttz%2F7jFNMVnnoGJNPjqhjwO67P7ZDD5TGe0XfHZuBwMsRS6hLARDeHjX007dToMnRUL6qSdduwJ5XFp1h%2BE6Rkz%2BkH%2BXIsCp5VcVtR88JtGb%2F9ULOOwArzNoovDT0wHNWBQzIbT9UpVn4MFStj%2BhIIbVLY6dujsTPP%2BrUvQy4hqA%2Bn0eKp9Ovi1Tve1oL8%2F06sjuBpMSK%2BlSsR0q0kmZIe%2FV%2F9fCzLkgNHQRnI2fqUQ%3D%3D",
            "is_enabled" => true,
            "origin_price" => 2000,
            "price" => 1500,
            "name" => "經典復刻伊姆斯椅",
            "unit" => "張",
            "quantity" => 4
        ]);

        Product::create([
            "id" => 19,
            "category_id" => 3,
            "desc" => "皮製經典復古沙發，是由多位大師級的工匠和設計師，經過不容妥協的選材和設計，再經由專家嚴格的多項耐用性和安全性的測試，聯手打造出兼具尊爵的視覺饗宴以及最高等級的使用體驗的產品。",
            "image_url" => "https://storage.googleapis.com/vue-course-api.appspot.com/chimoochi%2F1596807589517.jpg?GoogleAccessId=firebase-adminsdk-zzty7%40vue-course-api.iam.gserviceaccount.com&Expires=1742169600&Signature=eVTPHRyWtTG9%2Fjt9HwxYwgPo5x2yB%2B197QllDM3mY2oQnxM0pv%2BEa30MOq7%2FJJd9avZMU%2BeLz50XxQw3uQHGL7B5HG5V6GEAQi%2BSmjyBn8CpJDelDwDDd5EPzWi7jKVetjjI0B5n7WohyGGYF5KFYrDC2cZ2m7wQq3cHGBhpZy%2FRQDDBj23SE8XzdVdmBdIakGt4LBZsVCtyfC3QSvqJ%2FTnf9mfYbpKtC2n3dnVLgj17XA4lAlknBJF0u5au%2BhkasndGWOOBZSsda6uwmBbAuozX0mAZoLS5xyFRMIsmaRC6VplIWnA6HfGPq5vakALvH78LEt7gmBCADf%2BxyRbCNQ%3D%3D",
            "is_enabled" => true,
            "origin_price" => 4000,
            "price" => 3000,
            "name" => "現代極簡單人沙發床",
            "unit" => "組",
            "quantity" => 6
        ]);

        Product::create([
            "id" => 20,
            "category_id" => 3,
            "desc" => "皮製經典復古沙發，是由多位大師級的工匠和設計師，經過不容妥協的選材和設計，再經由專家嚴格的多項耐用性和安全性的測試，聯手打造出兼具尊爵的視覺饗宴以及最高等級的使用體驗的產品。",
            "image_url" => "https://storage.googleapis.com/vue-course-api.appspot.com/chimoochi%2F1596807352277.jpg?GoogleAccessId=firebase-adminsdk-zzty7%40vue-course-api.iam.gserviceaccount.com&Expires=1742169600&Signature=q0toEsv3KWu%2Fk0Vr0xkQzJbYAj6Xp2vG9ZHQjtubHWzogeHztfR3iCljhKRVaxTtKxh8Hk6kfDm3Ncu8na8UR%2F8WMHg8D8Cq1cWbxipy%2Fddy5vsEyGK7VVPJfAQRFlWyb%2Bhs1lb%2FS5Ax5AIWOikf5aQ3HAym38AUsP0H%2FZ7YqDO79r87L6f%2B7YNIvsW2Mq4%2B88kerWLXLmzoiPIK1wWf%2F3v%2FCOQpnKJLfbwsbVIxZ3Tp3o%2Blh6UEuhV4ZZQyPpuBN1uRVMAyrxjYqpLM2G0g8V1m8eMWdT0j7tKoFqXHOrIDxRZtUBHbBoDJCVYcM%2Fkb2Boz4%2BtqK5nPC1eLhXT%2FmQ%3D%3D",
            "is_enabled" => true,
            "origin_price" => 7000,
            "price" => 5250,
            "name" => "清新休閒單人沙發",
            "unit" => "組",
            "quantity" => 5
        ]);

        Product::create([
            "id" => 21,
            "category_id" => 1,
            "desc" => "皮製經典復古沙發，是由多位大師級的工匠和設計師，經過不容妥協的選材和設計，再經由專家嚴格的多項耐用性和安全性的測試，聯手打造出兼具尊爵的視覺饗宴以及最高等級的使用體驗的產品。",
            "image_url" => "https://storage.googleapis.com/vue-course-api.appspot.com/chimoochi%2F1596807834249.jpg?GoogleAccessId=firebase-adminsdk-zzty7%40vue-course-api.iam.gserviceaccount.com&Expires=1742169600&Signature=LE4hctS6lc7eHCdksnBbrSXRzULITBV3PIo75a9m%2F0jY%2FdRd5N8kAJEoW%2FaERHZVhDiKGUrXKc%2BF3y1jUPlIvmNf%2Fvks15uqLq8n5SNho0bdvhpU4tsy%2BMIefdHDrFaGWlUf%2F6imsJCIeC%2BQdcohXh59mccaFN7Gbq3D0%2F1%2FAjV%2BEyUrH8oEz1IAy1%2B4WWNzQS7hnM%2Bh8hdSOIdPoy3IMp%2FIezC4jOM0Hs945uGYsCigBCffyKsw63otwzlZeiFSeFd7lN3n1JTifvdUYXuUMxp3MYkc4tpX8NWcIw%2F5UbYBBJrPlORE5YynC3%2Bv4zRYIl6EXAScP73drSNRZweOrw%3D%3D",
            "is_enabled" => true,
            "origin_price" => 700,
            "price" => 525,
            "name" => "木製簡約風格椅",
            "unit" => "張",
            "quantity" => 7
        ]);

        Product::create([
            "id" => 22,
            "category_id" => 2,
            "desc" => "皮製經典復古沙發，是由多位大師級的工匠和設計師，經過不容妥協的選材和設計，再經由專家嚴格的多項耐用性和安全性的測試，聯手打造出兼具尊爵的視覺饗宴以及最高等級的使用體驗的產品。",
            "image_url" => "https://storage.googleapis.com/vue-course-api.appspot.com/chimoochi%2F1596808121874.jpg?GoogleAccessId=firebase-adminsdk-zzty7%40vue-course-api.iam.gserviceaccount.com&Expires=1742169600&Signature=G47K9FVBEYYubFzpPxadmjArIbptbpDzTQOfNvaEvUjfpZTrsNbgr5YtP%2Fnd1f98BL69khd89vmQqg%2BuAXNZs6TN7%2F8GupaqZBoUSh1EXfjvffzhvgQc3h7e%2FcHtf3U16pjSEqsn2ans2g44DzmUIfKRdBxzcK54xqQaJP7usFRbNAx88qPFXPa04xDQR5iOIvxB%2FSqwTSjPUtOYt4bwqz9cIXnhnu6ToQFjDcUhbt7eMb5Thmb3clt79WiORo%2BIHv4fbp3KFP9R%2F7wGWXg7m%2F4mQi%2FuaYSreIzzAgy3gHXW9Eef%2Fg4Uq3u0sD4Oea%2FQ4FoeICZnp8EUR8aWJW8D7w%3D%3D",
            "is_enabled" => true,
            "origin_price" => 2200,
            "price" => 1650,
            "name" => "流線造型餐椅",
            "unit" => "張",
            "quantity" => 2
        ]);

        Product::create([
            "id" => 23,
            "category_id" => 2,
            "desc" => "皮製經典復古沙發，是由多位大師級的工匠和設計師，經過不容妥協的選材和設計，再經由專家嚴格的多項耐用性和安全性的測試，聯手打造出兼具尊爵的視覺饗宴以及最高等級的使用體驗的產品。",
            "image_url" => "https://storage.googleapis.com/vue-course-api.appspot.com/chimoochi%2F1596809703312.jpg?GoogleAccessId=firebase-adminsdk-zzty7%40vue-course-api.iam.gserviceaccount.com&Expires=1742169600&Signature=VX%2Fga2hlC%2BQLSHOgND4ibJJR7pAxP3osu3JhIDiyO2zO%2FA4U1XhZStX8CSEYJe44%2FDRS%2FqW1BITDsaVEJTMfbdZJk33TM%2FkaWmotizx6hKfcfQDowzs68SmRBBG7raSg7%2Fl7WULvTEuSABWjf13R%2B%2FL0VHWHkQCwddwsv3eKQxqa2oDrWfkW9HweHlRW6nxXMFXQg02vq5swVKh4O9djH1m82wrJkGvYRYiwNR%2FKJ0xYYaXbO6YleBVJrjQub8MBPZszzOGgNF1VMkMH2qBFSECgS9uZXqdWrT3ER986o6u%2F1Uefo4UFHRIz89JCYEmWEUBmZP0GSxfxaWxnnjgG%2FQ%3D%3D",
            "is_enabled" => true,
            "origin_price" => 850,
            "price" => 638,
            "name" => "極簡單色調餐椅",
            "unit" => "張",
            "quantity" => 9
        ]);

    }
}
