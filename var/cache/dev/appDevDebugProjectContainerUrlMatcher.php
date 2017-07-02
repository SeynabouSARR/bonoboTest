<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appDevDebugProjectContainerUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevDebugProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $trimmedPathinfo = rtrim($pathinfo, '/');
        $context = $this->context;
        $request = $this->request;
        $requestMethod = $canonicalMethod = $context->getMethod();
        $scheme = $context->getScheme();

        if ('HEAD' === $requestMethod) {
            $canonicalMethod = 'GET';
        }


        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_wdt')), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if ('/_profiler' === $trimmedPathinfo) {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_profiler_home');
                    }

                    return array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                }

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ('/_profiler/search' === $pathinfo) {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ('/_profiler/search_bar' === $pathinfo) {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_info
                if (0 === strpos($pathinfo, '/_profiler/info') && preg_match('#^/_profiler/info/(?P<about>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_info')), array (  '_controller' => 'web_profiler.controller.profiler:infoAction',));
                }

                // _profiler_phpinfo
                if ('/_profiler/phpinfo' === $pathinfo) {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_search_results')), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler_open_file
                if ('/_profiler/open' === $pathinfo) {
                    return array (  '_controller' => 'web_profiler.controller.profiler:openAction',  '_route' => '_profiler_open_file',);
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler')), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_router')), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception')), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception_css')), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            // _twig_error_test
            if (0 === strpos($pathinfo, '/_error') && preg_match('#^/_error/(?P<code>\\d+)(?:\\.(?P<_format>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_twig_error_test')), array (  '_controller' => 'twig.controller.preview_error:previewErrorPageAction',  '_format' => 'html',));
            }

        }

        // homepage
        if ('' === $trimmedPathinfo) {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'homepage');
            }

            return array (  '_controller' => 'AppBundle\\Controller\\DefaultController::indexAction',  '_route' => 'homepage',);
        }

        // connecter
        if (0 === strpos($pathinfo, '/connecter') && preg_match('#^/connecter/(?P<login>[^/]++)/(?P<password>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'connecter')), array (  '_controller' => 'AppBundle\\Controller\\DefaultController::connecterAction',));
        }

        if (0 === strpos($pathinfo, '/ajouter')) {
            // ajouter
            if (preg_match('#^/ajouter/(?P<name>[^/]++)/(?P<age>[^/]++)/(?P<race>[^/]++)/(?P<food>[^/]++)/(?P<family>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'ajouter')), array (  '_controller' => 'AppBundle\\Controller\\DefaultController::ajouterAction',));
            }

            // ajouterAmi
            if (0 === strpos($pathinfo, '/ajouterAmi') && preg_match('#^/ajouterAmi/(?P<id_bonobo>[^/]++)/(?P<id_son_ami>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'ajouterAmi')), array (  '_controller' => 'AppBundle\\Controller\\DefaultController::ajouterAmiAction',));
            }

        }

        elseif (0 === strpos($pathinfo, '/update')) {
            // updateDB
            if (0 === strpos($pathinfo, '/updateDB') && preg_match('#^/updateDB/(?P<id>[^/]++)/(?P<name>[^/]++)/(?P<age>[^/]++)/(?P<race>[^/]++)/(?P<food>[^/]++)/(?P<family>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'updateDB')), array (  '_controller' => 'AppBundle\\Controller\\DefaultController::updateDBAction',));
            }

            // update
            if (preg_match('#^/update/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'update')), array (  '_controller' => 'AppBundle\\Controller\\DefaultController::updateAction',));
            }

        }

        elseif (0 === strpos($pathinfo, '/de')) {
            if (0 === strpos($pathinfo, '/delete')) {
                // delete2Amis
                if (0 === strpos($pathinfo, '/delete2Amis') && preg_match('#^/delete2Amis/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'delete2Amis')), array (  '_controller' => 'AppBundle\\Controller\\DefaultController::delete2AmisAction',));
                }

                // deleteAmis
                if (0 === strpos($pathinfo, '/deleteAmis') && preg_match('#^/deleteAmis/(?P<id_bonobo>[^/]++)/(?P<id_son_ami>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'deleteAmis')), array (  '_controller' => 'AppBundle\\Controller\\DefaultController::deleteAmisAction',));
                }

                // delete
                if (preg_match('#^/delete/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'delete')), array (  '_controller' => 'AppBundle\\Controller\\DefaultController::deleteAction',));
                }

            }

            // definirAmi
            if (0 === strpos($pathinfo, '/definirAmi') && preg_match('#^/definirAmi/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'definirAmi')), array (  '_controller' => 'AppBundle\\Controller\\DefaultController::definirAmiAction',));
            }

            // details
            if (0 === strpos($pathinfo, '/details') && preg_match('#^/details/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'details')), array (  '_controller' => 'AppBundle\\Controller\\DefaultController::detailsAction',));
            }

        }

        // liste
        if ('/liste' === $pathinfo) {
            return array (  '_controller' => 'AppBundle\\Controller\\DefaultController::listeAction',  '_route' => 'liste',);
        }

        // tout
        if ('/tout' === $pathinfo) {
            return array (  '_controller' => 'AppBundle\\Controller\\DefaultController::toutAction',  '_route' => 'tout',);
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
