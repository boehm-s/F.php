<?php

function _arity(Callable $fn) {
    /**
     * In PHP, we can pass methods as array, so we need to handle this case
     */
    if (is_array($fn)) {
        list($class, $method) = $fn;
        $reflectionClass = new ReflectionClass($class);
        $reflectionMethod = $reflectionClass->getMethod($method);
        $arguments = $reflectionMethod->getParameters();
    } else {
        $reflection = new ReflectionFunction($fn);
        $arguments = $reflection->getParameters();
    }

    return count($arguments);
}

function _call_fn_right_arity(callable $fn, array $args) {
    $fnArity = _arity($fn);
    $tailoredArgs = array_slice($args, 0, $fnArity);

    return $fn(...$tailoredArgs);
}
