<div>ホテル名: <span id="cf_hotel_name"></span></div><br>
<div>都道府県: <span id="cf_prefecture"></span></div><br>
@if ($hotel->file_path)
<div>イメージ画像: <span id="cf_image_unset"></span></div><br>
<img id="cf_image_preview" class="image_preview" src="/assets/img/{{$hotel->file_path}}" alt="" />
@else
<div>イメージ画像: <span id="cf_image_unset">なし</span></div><br>
<img id="cf_image_preview" class="image_preview" src="" alt="" />
@endif
<div class="mb-3 mt-3">
    <button type="submit" class="btn btn-primary" form="hotel_update">検索</button>
    <button type="button" class="btn btn-secondary ml-3" id="js_back_confirm">Back to confirm</button>
</div>

