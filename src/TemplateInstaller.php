<?php
namespace Forgeonline\FgInstaller;
use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;
class TemplateInstaller extends LibraryInstaller
{
    /**
     * {@inheritDoc}
     */
    public function getInstallPath(PackageInterface $package)
    {
        $prefix = substr($package->getPrettyName(), 0, 11);
        if ('forgeonline' !== $prefix) {
            throw new \InvalidArgumentException(
                'Unable to install template, forgeonline backend installer '
                .'should always start their package name with '
                .'"forgeonline"'
            );
        }
        $tmpModule = $this->getModuelInstallName( substr($package->getPrettyName(), 12) );
        return 'module/'.$tmpModule ;
    }
    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return 'forgeonline-forgezf' === $packageType;
    }
    
    public function getModuelInstallName( $prefixname ){
        $tmp = ucwords( str_replace("-", " ", $prefixname ) );
        return str_replace(" ","", $tmp );
    }
}
