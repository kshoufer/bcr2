/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
        var ddlFormat;

        $(document).ready(function () {
            onFormatChange();
            
            $("#ddlFormat").change(function () {
                ddlFormat = $("#ddlFormat").val();
                onFormatChange();
            });
            
            if (!ddlFormat) {
                    ddlFormat = $("#ddlFormat").val();
                }

            $("#btnSaveForm").click(function () {
                if (ddlFormat == '1')
                    {
                        if (!isFloatInRange($("#txtLatDeg1").val(), -90, 90)) {
                            alert("Latitude must be a number in [-90, 90]");
                            return;
                        }
                        if (!isFloatInRange($("#txtLonDeg1").val(), -180, 180)) {
                            alert("Longitude must be a number in [-180, 180]");
                            return;
                        }
                        createGoogleMapsLink($("#txtLatDeg1").val(), $("#txtLonDeg1").val());
                    }

                if (ddlFormat == '2')
                    {
                        if (!isIntInRange($("#txtLatDeg2").val(), 0, 90)) {
                            alert("Latitude-degree must be an integer in [0, 90]");
                            return;
                        }
                        if (!isFloatInRange($("#txtLatMin2").val(), 0, 60)) {
                            alert("Latitude-minute must be a number in [0, 60]");
                            return;
                        }
                        if (!isIntInRange($("#txtLonDeg2").val(), 0, 180)) {
                            alert("Longitude-degree must be an integer in [0, 180]");
                            return;
                        }
                        if (!isFloatInRange($("#txtLonMin2").val(), 0, 60)) {
                            alert("Longitude-minute must be a number in [0, 60]");
                            return;
                        }
                        var lat = parseFloat($("#txtLatDeg2").val()) + parseFloat($("#txtLatMin2").val()) / 60;
                        if (lat > 90) lat = 90;
                        lat = ($("#txtLatDir2 option:selected").text() == "N") ? lat : -lat;

                        var lon = parseFloat($("#txtLonDeg2").val()) + parseFloat($("#txtLonMin2").val()) / 60;
                        if (lon > 180) lon = 180;
                        lon = ($("#txtLonDir2 option:selected").text() == "E") ? lon : -lon;

                        createGoogleMapsLink(lat, lon);
                    }
                    
                if (ddlFormat == '3')
                    {
                        if (!isIntInRange($("#txtLatDeg3").val(), 0, 90)) {
                            alert("Latitude-degree must be an integer in [0, 90]");
                            return;
                        }
                        if (!isIntInRange($("#txtLatMin3").val(), 0, 60)) {
                            alert("Latitude-minute must be an integer in [0, 60]");
                            return;
                        }
                        if (!isFloatInRange($("#txtLatSec3").val(), 0, 60)) {
                            alert("Latitude-second must be a number in [0, 60]");
                            return;
                        }
                        if (!isIntInRange($("#txtLonDeg3").val(), 0, 180)) {
                            alert("Longitude-degree must be an integer in [0, 180]");
                            return;
                        }
                        if (!isIntInRange($("#txtLonMin3").val(), 0, 60)) {
                            alert("Longitude-minute must be an integer in [0, 60]");
                            return;
                        }
                        if (!isFloatInRange($("#txtLonSec3").val(), 0, 60)) {
                            alert("Longitude-second must be a number in [0, 60]");
                            return;
                        }
                        var lat = parseFloat($("#txtLatDeg3").val()) + parseFloat($("#txtLatMin3").val()) / 60 + parseFloat($("#txtLatSec3").val()) / 3600;
                        if (lat > 90) lat = 90;
                        lat = ($("#txtLatDir3 option:selected").text() == "N") ? lat : -lat;

                        var lon = parseFloat($("#txtLonDeg3").val()) + parseFloat($("#txtLonMin3").val()) / 60 + parseFloat($("#txtLonSec3").val()) / 3600;
                        if (lon > 180) lon = 180;
                        lon = ($("#txtLonDir3 option:selected").text() == "E") ? lon : -lon;

                        createGoogleMapsLink(lat, lon);
                    }
            });
        });

        function onFormatChange() {
            var format = $("#ddlFormat").val();
            if (format == 1) {
                $("#d").show();
                $("#dm").hide();
                $("#dms").hide();
            }
            else if (format == 2) {
                $("#d").hide();
                $("#dm").show();
                $("#dms").hide();
            }
            else if (format == 3) {
                $("#d").hide();
                $("#dm").hide();
                $("#dms").show();
            }
            $(".intBox").val("");
            $(".floatBox").val("");
            $(".dirDropdown").prop('selectedIndex', 0);
            $("#mapLink").empty();
        }

        //check if number f is in [a, b]
        function isFloatInRange(f, a, b) {
            if (isNaN(f)) return false;
            return (f >= a && f <= b);
        }
        //check if integer i is in [a, b] 
        function isIntInRange(i, a, b) {
            if (isNaN(i)) return false;
            if (i % 1 === 0)
                return (i >= a && i <= b);
            else
                return false;
        }
        function createGoogleMapsLink(lat, lon) {
            var zm = 15;
            var mapLink;
            var url = "https://maps.google.com/maps?q=" + lat + "," + lon + "&z=" + zm;
            $("#mapLink").empty();
            $("#mapLink").val('<a href="' + url + '" target="_blank">Google Maps Link</a>');
        }

