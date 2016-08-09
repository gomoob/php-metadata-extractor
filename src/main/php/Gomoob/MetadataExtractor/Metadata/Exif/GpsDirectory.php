<?php

/**
 * gomoob/php-metadata-extractor
 *
 * @copyright Copyright (c) 2016, GOMOOB SARL (http://gomoob.com)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE.md file)
 */
namespace Gomoob\MetadataExtractor\Metadata\Exif;

use Gomoob\MetadataExtractor\Metadata\Directory;

/**
 * Describes Exif tags that contain Global Positioning System (GPS) data.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
class GpsDirectory extends Directory
{
    /** GPS tag version GPSVersionID 0 0 BYTE 4 */
    const TAG_VERSION_ID = 0x0000;
    /** North or South Latitude GPSLatitudeRef 1 1 ASCII 2 */
    const TAG_LATITUDE_REF = 0x0001;
    /** Latitude GPSLatitude 2 2 RATIONAL 3 */
    const TAG_LATITUDE = 0x0002;
    /** East or West Longitude GPSLongitudeRef 3 3 ASCII 2 */
    const TAG_LONGITUDE_REF = 0x0003;
    /** Longitude GPSLongitude 4 4 RATIONAL 3 */
    const TAG_LONGITUDE = 0x0004;
    /** Altitude reference GPSAltitudeRef 5 5 BYTE 1 */
    const TAG_ALTITUDE_REF = 0x0005;
    /** Altitude GPSAltitude 6 6 RATIONAL 1 */
    const TAG_ALTITUDE = 0x0006;
    /** GPS time (atomic clock) GPSTimeStamp 7 7 RATIONAL 3 */
    const TAG_TIME_STAMP = 0x0007;
    /** GPS satellites used for measurement GPSSatellites 8 8 ASCII Any */
    const TAG_SATELLITES = 0x0008;
    /** GPS receiver status GPSStatus 9 9 ASCII 2 */
    const TAG_STATUS = 0x0009;
    /** GPS measurement mode GPSMeasureMode 10 A ASCII 2 */
    const TAG_MEASURE_MODE = 0x000A;
    /** Measurement precision GPSDOP 11 B RATIONAL 1 */
    const TAG_DOP = 0x000B;
    /** Speed unit GPSSpeedRef 12 C ASCII 2 */
    const TAG_SPEED_REF = 0x000C;
    /** Speed of GPS receiver GPSSpeed 13 D RATIONAL 1 */
    const TAG_SPEED = 0x000D;
    /** Reference for direction of movement GPSTrackRef 14 E ASCII 2 */
    const TAG_TRACK_REF = 0x000E;
    /** Direction of movement GPSTrack 15 F RATIONAL 1 */
    const TAG_TRACK = 0x000F;
    /** Reference for direction of image GPSImgDirectionRef 16 10 ASCII 2 */
    const TAG_IMG_DIRECTION_REF = 0x0010;
    /** Direction of image GPSImgDirection 17 11 RATIONAL 1 */
    const TAG_IMG_DIRECTION = 0x0011;
    /** Geodetic survey data used GPSMapDatum 18 12 ASCII Any */
    const TAG_MAP_DATUM = 0x0012;
    /** Reference for latitude of destination GPSDestLatitudeRef 19 13 ASCII 2 */
    const TAG_DEST_LATITUDE_REF = 0x0013;
    /** Latitude of destination GPSDestLatitude 20 14 RATIONAL 3 */
    const TAG_DEST_LATITUDE = 0x0014;
    /** Reference for longitude of destination GPSDestLongitudeRef 21 15 ASCII 2 */
    const TAG_DEST_LONGITUDE_REF = 0x0015;
    /** Longitude of destination GPSDestLongitude 22 16 RATIONAL 3 */
    const TAG_DEST_LONGITUDE = 0x0016;
    /** Reference for bearing of destination GPSDestBearingRef 23 17 ASCII 2 */
    const TAG_DEST_BEARING_REF = 0x0017;
    /** Bearing of destination GPSDestBearing 24 18 RATIONAL 1 */
    const TAG_DEST_BEARING = 0x0018;
    /** Reference for distance to destination GPSDestDistanceRef 25 19 ASCII 2 */
    const TAG_DEST_DISTANCE_REF = 0x0019;
    /** Distance to destination GPSDestDistance 26 1A RATIONAL 1 */
    const TAG_DEST_DISTANCE = 0x001A;
    
    /** Values of "GPS", "CELLID", "WLAN" or "MANUAL" by the EXIF spec. */
    const TAG_PROCESSING_METHOD = 0x001B;
    const TAG_AREA_INFORMATION = 0x001C;
    const TAG_DATE_STAMP = 0x001D;
    const TAG_DIFFERENTIAL = 0x001E;

    private static $tagNameMap = [
            self::TAG_VERSION_ID => "GPS Version ID",
            self::TAG_LATITUDE_REF => "GPS Latitude Ref",
            self::TAG_LATITUDE => "GPS Latitude",
            self::TAG_LONGITUDE_REF => "GPS Longitude Ref",
            self::TAG_LONGITUDE => "GPS Longitude",
            self::TAG_ALTITUDE_REF => "GPS Altitude Ref",
            self::TAG_ALTITUDE => "GPS Altitude",
            self::TAG_TIME_STAMP => "GPS Time-Stamp",
            self::TAG_SATELLITES => "GPS Satellites",
            self::TAG_STATUS => "GPS Status",
            self::TAG_MEASURE_MODE => "GPS Measure Mode",
            self::TAG_DOP => "GPS DOP",
            self::TAG_SPEED_REF => "GPS Speed Ref",
            self::TAG_SPEED => "GPS Speed",
            self::TAG_TRACK_REF => "GPS Track Ref",
            self::TAG_TRACK => "GPS Track",
            self::TAG_IMG_DIRECTION_REF => "GPS Img Direction Ref",
            self::TAG_IMG_DIRECTION => "GPS Img Direction",
            self::TAG_MAP_DATUM => "GPS Map Datum",
            self::TAG_DEST_LATITUDE_REF => "GPS Dest Latitude Ref",
            self::TAG_DEST_LATITUDE => "GPS Dest Latitude",
            self::TAG_DEST_LONGITUDE_REF => "GPS Dest Longitude Ref",
            self::TAG_DEST_LONGITUDE => "GPS Dest Longitude",
            self::TAG_DEST_BEARING_REF => "GPS Dest Bearing Ref",
            self::TAG_DEST_BEARING => "GPS Dest Bearing",
            self::TAG_DEST_DISTANCE_REF => "GPS Dest Distance Ref",
            self::TAG_DEST_DISTANCE => "GPS Dest Distance",
            self::TAG_PROCESSING_METHOD => "GPS Processing Method",
            self::TAG_AREA_INFORMATION => "GPS Area Information",
            self::TAG_DATE_STAMP => "GPS Date Stamp",
            self::TAG_DIFFERENTIAL => "GPS Differential"
    ];

    public function __construct()
    {
        $this->setDescriptor(new GpsDescriptor($this));
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'GPS';
    }

    /**
     * {@inheritDoc}
     */
    protected function getTagNameMap()
    {
        return static::$tagNameMap;
    }
}
