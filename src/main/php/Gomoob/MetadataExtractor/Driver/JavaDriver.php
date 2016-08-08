<?php

/**
 * Copyright 2016 SARL GOMOOB. All rights reserved.
 */
namespace Gomoob\MetadataExtractor\Driver;

use Alchemy\BinaryDriver\AbstractBinary;

use Alchemy\BinaryDriver\Configuration;
use Alchemy\BinaryDriver\ConfigurationInterface;
use Alchemy\BinaryDriver\Exception\ExecutableNotFoundException;

use Psr\Log\LoggerInterface;

/**
 * Binary driver used to drive the 'java' executable.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
class JavaDriver extends AbstractBinary
{

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'metadata-extractor';
    }

    /**
     * Creates a driver instance.
     *
     * @param LoggerInterface     $logger
     * @param array|Configuration $configuration
     *
     * @return \Gomoob\MediaInfo\Driver\MediaInfoDriver the created MediaInfoDriver instance.
     */
    public static function create(LoggerInterface $logger = null, $configuration = [])
    {
        if (!$configuration instanceof ConfigurationInterface) {
            $configuration = new Configuration($configuration);
        }

        $binaries = $configuration->get('java', ['java']);

        if (!$configuration->has('timeout')) {
            $configuration->set('timeout', 300);
        }

        try {
            return static::load($binaries, $logger, $configuration);
        } catch (BinaryDriverExecutableNotFound $e) {
            throw new ExecutableNotFoundException('Unable to load java', $e->getCode(), $e);
        }
    }
}
