Livewire.hook("component.init", ({ component, cleanup }) => {
    console.log("component map.js");
    Alpine.data("map", () => ({
        map: null,
        marker: null,
        markers: [],
        markers2: [],

        async initMap(markers, useOnClickMarker) {
            console.log("init map", markers);
            let position;

            const { Map } = await google.maps.importLibrary("maps");

            /* default location */
            position = {
                lat: -8.061696808121564,
                lng: 111.41618869684972,
            };

            if (markers.length > 0) {
                position = {
                    lat: parseFloat(markers[0].lat),
                    lng: parseFloat(markers[0].lng),
                };
            }

            // The map, centered at Uluru
            this.map = new Map(document.getElementById("map"), {
                zoom: 8,
                center: position,
                mapId: "DEMO_MAP_ID",
            });

            if (markers !== null && markers.length != 0) {
                /* add marker */
                markers.forEach((location) => {
                    position = {
                        lat: parseFloat(location.lat),
                        lng: parseFloat(location.lng),
                    };

                    this.addMarker(position, location.id);
                });
            }

            this.map.addListener("click", (mapsMouseEvent) => {
                if (!useOnClickMarker) return;

                const position = mapsMouseEvent.latLng.toJSON(); // Koordinat lokasi klik
                this.$dispatch("on-click-map", position);

                console.log("markers", this.markers2);
                // remove all marker
                if (this.marker) {
                    this.clearMarker();
                }

                if (this.markers2) {
                    this.clearMarkers();
                }

                this.addMarker(position, null);
            });
        },

        /* clear the single marker */
        clearMarker() {
            this.marker.setVisible(false); //this line works
            this.marker.setMap(null);
            this.marker.setPosition(null);
            this.marker = null;
        },

        async addMarker(position, id) {
            const { Marker } = await google.maps.importLibrary("marker");

            const marker = new Marker({
                map: this.map,
                position: position,
                title: "",
            });

            if (id) {
                marker.addListener("click", () => {
                    console.log(`You clicked on: ` + id);
                    // Livewire.dispatch("openModal", {
                    //     component: "modals.detail-planting-activity",
                    //     arguments: { id: id },
                    // });
                });
            }

            this.markers2.push(marker);
        },

        /* clear all markers */
        clearMarkers() {
            this.markers2.forEach((marker) => {
                marker.setVisible(false); //this line works
                marker.setMap(null);
                marker.setPosition(null);
                marker = null;
            }); // Hapus marker dari peta
            this.markers = []; // Kosongkan array markers
            this.markers2 = []; // Kosongkan array markers
        },

        rerenderMarker(markers) {
            this.clearMarkers();

            /* render again */
            if (markers !== null && markers.length != 0) {
                /* add marker */
                markers.forEach((itemMarker) => {
                    itemMarker.forEach((marker) => {
                        const position = {
                            lat: parseFloat(marker.lat),
                            lng: parseFloat(marker.lng),
                        };
                        this.addMarker(position, marker.id);
                    });
                });
            }
        },
        /* set marker form text input */
        setMarkerTest(position) {
            console.log("set marker", position);
            this.addMarker(position, null);
        },
    }));
});
