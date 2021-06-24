<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = [
            [ 'name' => 'Autá', 'slug' => 'auta', 'parent_id' => null, 'fa_icon_class' => 'fas fa-car-side'],
            [ 'name' => 'Motocykle', 'slug' => 'motocykle', 'parent_id' => null, 'fa_icon_class' => 'fas motorcycle'],
            [ 'name' => 'Detské potreby', 'slug' => 'detske-potreby', 'parent_id' => null, 'fa_icon_class' => 'fas fa-baby-carriage'],
            [ 'name' => 'Praca', 'slug' => 'praca', 'parent_id' => null, 'fa_icon_class' => 'fas briefcase'],
            [ 'name' => 'Reality', 'slug' => 'reality', 'parent_id' => null, 'fa_icon_class' => 'fas building'],
            [ 'name' => 'Zvieratá', 'slug' => 'zvierata', 'parent_id' => null, 'fa_icon_class' => 'fas fa-dog'],
            [ 'name' => 'Stroje a náradie', 'slug' => 'stroje-a-naradie', 'parent_id' => null, 'fa_icon_class' => 'fas tools'],
            [ 'name' => 'Dom a záhrada', 'slug' => 'dom-a-zahrada', 'parent_id' => null, 'fa_icon_class' => 'fas home'],
            [ 'name' => 'Počítače', 'slug' => 'pocitace', 'parent_id' => null, 'fa_icon_class' => 'fas laptop'],
            [ 'name' => 'Mobily', 'slug' => 'mobily', 'parent_id' => null, 'fa_icon_class' => 'fas mobile-alt'],
            [ 'name' => 'Foto a video', 'slug' => 'foto-a-video', 'parent_id' => null, 'fa_icon_class' => 'fas photo-video'],
            [ 'name' => 'Elektro', 'slug' => 'elektro', 'parent_id' => null, 'fa_icon_class' => 'fas plug'],
            [ 'name' => 'Šport', 'slug' => 'sport', 'parent_id' => null, 'fa_icon_class' => 'fas biking'],
            [ 'name' => 'Hudba', 'slug' => 'hudba', 'parent_id' => null, 'fa_icon_class' => 'fas music'],
            [ 'name' => 'Knihy', 'slug' => 'knihy', 'parent_id' => null, 'fa_icon_class' => 'fas book'],
            [ 'name' => 'Nábytok', 'slug' => 'nabytok', 'parent_id' => null, 'fa_icon_class' => 'fas couch'],
            [ 'name' => 'Oblečenie a obuv', 'slug' => 'oblecenie-a-obuv', 'parent_id' => null, 'fa_icon_class' => 'fas tshirt'],
            [ 'name' => 'Služby', 'slug' => 'sluzby', 'parent_id' => null, 'fa_icon_class' => 'fas ups'],
            [ 'name' => 'Ostatné', 'slug' => 'ostatne', 'parent_id' => null, 'fa_icon_class' => 'fas layer-group'],
        ];

        foreach ($a as $item)
        {
            if ( ! (\App\Category::where([
                'name' => $item['name'], 'slug' => $item['slug'], 'parent_id' => $item['parent_id'],
            ])->first()) )
            {
                 DB::table('categories')->insertOrIgnore($item);
            }

        }
    }
}
