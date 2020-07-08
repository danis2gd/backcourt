import React, { useState, useEffect } from 'react';

export function useFetchOnce(route) {
    const [response, setResponse] = useState(null)
    const [loading, setLoading] = useState(false)
    const [error, setError] = useState(null)

    useEffect(() => {
        fetch(Routing.generate(route))
            .then(response => response.json())
            .then(
                (result) => {
                    setResponse(result.data)
                    setLoading(true)
                },
                (error) => {
                    setError(error.message)
                    setLoading(true)
                }
            )
    }, [])

    return [ response, loading, error ]
}

export function useFetch(route) {
    const [response, setResponse] = useState(null)
    const [loading, setLoading] = useState(false)
    const [error, setError] = useState(null)

    useEffect(() => {
        fetch(Routing.generate(route))
            .then(response => response.json())
            .then(
                (result) => {
                    setResponse(result.data)
                    setLoading(true)
                },
                (error) => {
                    setError(error.message)
                    setLoading(true)
                }
            )
    })

    return [ response, loading, error ]
}