<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div x-data="{
        setLatLong(latlong) {
            console.log('on set lat long');
            $store.form.latitude = latlong.lat;
            $store.form.longitude = latlong.lng;
        }
    }">
        <div x-data="map()" x-init="initMap(@js($markers), @js($useOnClickMarker))" x-on:on-update-marker.window="rerenderMarker(event.detail)"
            x-on:set-marker.window="setMarkerTest(event.detail)"
            @if ($useOnClickMarker) @on-click-map="setLatLong(event.detail)" @endif>
            <div id="map" class="w-full h-96 rounded-lg shadow-lg"></div>
        </div>
    </div>
</div>
