<?php

/*
 * This file is part of Composer.
 *
 * (c) Nils Adermann <naderman@naderman.de>
 *     Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class ClassLoader
{
    private $prefixes = array();
    private $classMap = array();

    public function getPrefixes()
    {
        return $this->prefixes;
    }

    public function getClassMap()
    {
        return $this->classMap;
    }

    /**
     * @param array $classMap Class to filename map
     */
    public function addClassMap(array $classMap)
    {
        if ($this->classMap) {
            $this->classMap = array_merge($this->classMap, $classMap);
        } else {
            $this->classMap = $classMap;
        }
    }

    /**
     * Registers a set of classes, merging with any others previously set.
     *
     * @param string       $prefix  The classes prefix
     * @param array|string $paths   The location(s) of the classes
     * @param bool         $prepend Prepend the location(s)
     */
    public function add($prefix, $paths, $prepend = false)
    {
        if (!isset($this->prefixes[$prefix])) {
            $this->prefixes[$prefix] = (array) $paths;

            return;
        }
        if ($prepend) {
            $this->prefixes[$prefix] = array_merge(
                (array) $paths,
                $this->prefixes[$prefix]
            );
        } else {
            $this->prefixes[$prefix] = array_merge(
                $this->prefixes[$prefix],
                (array) $paths
            );
        }
    }

    /**
     * Registers a set of classes, replacing any others previously set.
     *
     * @param string       $prefix  The classes prefix
     * @param array|string $paths   The location(s) of the classes
     */
    public function set($prefix, $paths)
    {
        $this->prefixes[$prefix] = (array) $paths;
    }

    /**
     * Registers this instance as an autoloader.
     *
     * @param bool $prepend Whether to prepend the autoloader or not
     */
    public function register($prepend = false)
    {
        spl_autoload_register(array($this, 'loadClass'), true);
    }

    /**
     * Unregisters this instance as an autoloader.
     */
    public function unregister()
    {
        spl_autoload_unregister(array($this, 'loadClass'));
    }

    /**
     * Loads the given class or interface.
     *
     * @param  string    $class The name of the class
     * @return bool|null True if loaded, null otherwise
     */
    public function loadClass($class)
    {
        if ($file = $this->findFile($class)) {
            include $file;

            return true;
        }
    }

    /**
     * Finds the path to the file where the class is defined.
     *
     * @param string $class The name of the class
     *
     * @return string|false The path if found, false otherwise
     */
    public function findFile($class)
    {
        $classPath = str_replace('_', DIRECTORY_SEPARATOR, $class) . '.php';

        foreach ($this->prefixes as $prefix => $dirs) {
            if (0 == strpos($class, $prefix)) {
                foreach ($dirs as $dir) {
                    if (file_exists($dir . DIRECTORY_SEPARATOR . $classPath)) {
                        return $dir . DIRECTORY_SEPARATOR . $classPath;
                    }
                }
            }
        }

        return $this->classMap[$class] = false;
    }
}
