<?php

/**
 * Copyright 2016 SARL GOMOOB. All rights reserved.
*/
namespace Gomoob\BinaryDriver;

use Gomoob\Java\Io\IOException;

/**
 * Binary driver which extends the {@link JavaDriver} binary driver to easier calls to the `metadata-extractor` Java
 * library.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
class MetadataExtractorDriver extends JavaDriver
{
    /**
     * The absolute path to the 'src/main/resource/jars' directory
     *
     * @var string
     */
    private static $INITIAL_JARS_DIRECTORY = __DIR__ . '/../../../resources/jars';

    /**
     * The name of the main Java class used to call the `metadata-extractor` library.
     *
     * @var string
     */
    const MAIN_JAVA_CLASS_NAME = 'com.drew.imaging.ImageMetadataReader';

    /**
     * {@inheritdoc}
     */
    public function command($command, $bypassErrors = false, $listeners = null)
    {
        return parent::command(
            array_merge(
                [
                    '-classpath',
                    $this->createClasspath(),
                    MetadataExtractorDriver::MAIN_JAVA_CLASS_NAME
                ],
                $command
            ),
            $bypassErrors,
            $listeners
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'metadata-extractor';
    }
    
    /**
     * Utility method used to create the Java classpath required to call the `metadata-extractor` library.
     *
     * @return string the Java classpath required to call the `metadata-extractor` library.
     */
    protected function createClasspath()
    {
        // Gets the absolute path to the 'src/main/resources/jars' directory
        $jarsDirectory = realpath(static::$INITIAL_JARS_DIRECTORY);
    
        // The jars directory must exist
        if ($jarsDirectory === false) {
            throw new IOException(
                'The initial JARs directory \'' . static::$INITIAL_JARS_DIRECTORY . '\' does not exists !'
            );
        }

        // Normalize the jars directory for cross-platform Java classpath and returns the result
        return str_replace('\\', '/', $jarsDirectory)  . '/*';
    }
}
