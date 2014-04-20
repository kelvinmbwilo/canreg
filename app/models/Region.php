<?php


class Region extends Eloquent {

    protected $table = 'regions';

    protected  $guarded = array('id');

    public function district(){
        return $this->hasMany('District', 'region_id', 'id');
    }


    static function tribesList(){
        ?>
  <select name="tribe" id="tribe" class="form-control">
      <option selected="selected" disabled="disabled">Select Tribe</option>     
    <option>Alagwa</option>
    <option>Akiek</option>
    <option>Arusha</option>
    <option>Assa</option>
    <option>Barabaig</option>
    <option>Bembe</option>
    <option>Bena</option>
    <option>Bende</option>
    <option>Bondei</option>
    <option>Bungu</option>
    <option>Burunge</option>
    <option>Chaga</option>
    <option>Datooga</option>
    <option>Dhaiso</option>
    <option>Digo</option>
    <option>Doe</option>
    <option>Fipa</option>
    <option>Gogo</option>
    <option>Gorowa</option>
    <option>Gweno</option>
    <option>Ha</option>
    <option>Hadza</option>
    <option>Hangaza</option>
    <option>Haya</option>
    <option>Hehe</option>
    <option>Ikizu</option>
    <option>Ikoma</option>
    <option>Iraqw</option>
    <option>Isanzu</option>
    <option>Jiji</option>
    <option>Jita</option>
    <option>Kabwa</option>
    <option>Kagura</option>
    <option>Kaguru</option>
    <option>Kahe</option>
    <option>Kami</option>
    <option>Kara (also called <i>Regi</i>)</option>
    <option>Kerewe</option>
    <option>Kimbu</option>
    <option>Kinga</option>
    <option>Kisankasa</option>
    <option>Kisi</option>
    <option>Konongo</option>
    <option>Kuria</option>
    <option>Kutu</option>
    <option>Kw'adza</option>
    <option>Kwavi</option>
    <option>Kwaya</option>
    <option>Kwere</option>
    <option>Kwifa</option>
    <option>Lambya</option>
    <option>Luguru</option>
    <option>Luo</option>
    <option>Maasai</option>
    <option>Machinga</option>
    <option>Magoma</option>
    <option>Makonde</option>
    <option>Makua</option>
    <option>Makwe</option>
    <option>Malila</option>
    <option>Mambwe</option>
    <option>Manda</option>
    <option>Matengo</option>
    <option>Matumbi</option>
    <option>Maviha</option>
    <option>Mbugwe</option>
    <option>Mbunga</option>
    <option>Meru (Wameru of the slopes of Mt. Meru in Arumeru District)</option>
    <option>Mosiro</option>
    <option>Mpoto</option>
    <option>Mwanga</option>
    <option>Mwera</option>
    <option>Ndali</option>
    <option>Ndamba</option>
    <option>Ndendeule</option>
    <option>Ndengereko</option>
    <option>Ndonde</option>
    <option>Ngasa</option>
    <option>Ngindo</option>
    <option>Ngoni</option>
    <option>Ngulu</option>
    <option>Ngurimi</option>
    <option>Ngwele</option>
    <option>Nilamba</option>
    <option>Nindi</option>
    <option>Nyakyusa</option>
    <option>Nyambo</option>
    <option>Nyamwanga</option>
    <option>Nyamwezi</option>
    <option>Nyanyembe</option>
    <option>Nyaturu</option>
    <option>Nyiha</option>
    <option>Nyiramba</option>
    <option>Pangwa</option>
    <option>Pare</option>
    <option>Pimbwe</option>
    <option>Pogolo</option>
    <option>Rangi</option>
    <option>Rufiji</option>
    <option>Rungi</option>
    <option>Rungu</option>
    <option>Rungwa</option>
    <option>Rwa</option>
    <option>Safwa</option>
    <option>Sagara</option>
    <option>Sandawe</option>
    <option>Sangu</option>
    <option>Segeju</option>
    <option>Shambaa</option>
    <option>Shirazi</option>
    <option>Shubi</option>
    <option>Sizaki</option>
    <option>Suba</option>
    <option>Sukuma</option>
    <option>Sumbwa</option>
    <option>Swahili</option>
    <option>Temi</option>
    <option>Tongwe</option>
    <option>Tumbuka</option>
    <option>Vidunda</option>
    <option>Vinza</option>
    <option>Wanda</option>
    <option>Wanji</option>
    <option>Ware</option>
    <option>Yao</option>
    <option>Zanaki</option>
    <option>Zaramo</option>
    <option>Zigula</option>
    <option>Zinza</option>
    <option>Zyoba</option>
</select>
       <?php
    }
}


