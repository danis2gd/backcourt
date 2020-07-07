import React, { useState, useEffect } from 'react';

export function useFetch(route) {
    const [response, setResponse] = useState(null)
    const [loading, setLoading] = useState(false)
    const [hasError, setHasError] = useState(false)

    useEffect(() => {
        fetch(Routing.generate(route))
            .then(response => response.json())
            .then(
                (result) => {
                    setResponse(result.data)
                    setLoading(true)
                },
                (error) => {
                    setHasError(true)
                    setLoading(true)
                }
            )
    }, [ response ])

    return [ response, loading, hasError ]
}