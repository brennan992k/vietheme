<?php
                                                $jsonFile =  base_path() ."/resources/lang/es/es.json";
                                                $array =  json_decode(file_get_contents($jsonFile), true);
                                                return $array;