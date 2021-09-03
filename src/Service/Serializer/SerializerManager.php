<?php
namespace App\Service\Serializer;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\YamlFileLoader;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Doctrine\Common\Annotations\AnnotationReader;

class SerializerManager
{

    public function generate($param): Serializer
    {
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getId();
            },
        ];
        $encoders = [new JsonEncoder()];
       // $classMetadataFactory = new ClassMetadataFactory(new YamlFileLoader('../config/packages/serializer/'.$param.'.yaml'));
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        //$classMetadataFactory = new ClassMetadataFactory(new YamlFileLoader('../config/packages/serializer/'.$param.'.yaml'));
        $metadataAwareNameConverter = new MetadataAwareNameConverter($classMetadataFactory);
        $normalizers = [new DateTimeNormalizer(),new ObjectNormalizer($classMetadataFactory,$metadataAwareNameConverter, null, null, null, null, $defaultContext)];

        // $serializer = new Serializer($normalizers, $encoders);
        $serializer = new Serializer($normalizers);
        return $serializer;
    }
}