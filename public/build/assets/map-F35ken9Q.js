Livewire.hook("component.init",({component:i,cleanup:n})=>{console.log("component map.js"),Alpine.data("map",()=>({map:null,marker:null,markers:[],markers2:[],async initMap(a,e){console.log("init map",a);let t;const{Map:l}=await google.maps.importLibrary("maps");t={lat:-8.061696808121564,lng:111.41618869684972},a.length>0&&(t={lat:parseFloat(a[0].lat),lng:parseFloat(a[0].lng)}),this.map=new l(document.getElementById("map"),{zoom:8,center:t,mapId:"DEMO_MAP_ID"}),a!==null&&a.length!=0&&a.forEach(s=>{t={lat:parseFloat(s.lat),lng:parseFloat(s.lng)},this.addMarker(t,s.id)}),this.map.addListener("click",s=>{if(!e)return;const r=s.latLng.toJSON();this.$dispatch("on-click-map",r),console.log("markers",this.markers2),this.marker&&this.clearMarker(),this.markers2&&this.clearMarkers(),this.addMarker(r,null)})},clearMarker(){this.marker.setVisible(!1),this.marker.setMap(null),this.marker.setPosition(null),this.marker=null},async addMarker(a,e){const{Marker:t}=await google.maps.importLibrary("marker"),l=new t({map:this.map,position:a,title:""});e&&l.addListener("click",()=>{console.log("You clicked on: "+e)}),this.markers2.push(l)},clearMarkers(){this.markers2.forEach(a=>{a.setVisible(!1),a.setMap(null),a.setPosition(null),a=null}),this.markers=[],this.markers2=[]},rerenderMarker(a){this.clearMarkers(),a!==null&&a.length!=0&&a.forEach(e=>{e.forEach(t=>{const l={lat:parseFloat(t.lat),lng:parseFloat(t.lng)};this.addMarker(l,t.id)})})},setMarkerTest(a){console.log("set marker",a),this.addMarker(a,null)}}))});
