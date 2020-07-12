import '../base/common.js';

import React, { useState, useEffect } from 'react';
import { BrowserRouter, Route, Switch } from 'react-router-dom';
import ReactDOM from 'react-dom';

import { useFetchOnce } from '../inc/fetch';

import TeamCard from '../components/team/team_card';

const App = () => {
    return (
        <main>
            <Switch>
                <Route path="/app" component={Home} exact />
                <Route component={Error} />
            </Switch>
        </main>
    )
}

const Home = () => {
    const [data, loading, error] = useFetchOnce('api_basic_data');

    if (error !== null) {
        console.log('error');
    } else if (!loading) {
        return <div>Loading...</div>
    } else {
        return (
            <>
                <div className="container">
                    <div className="row">
                        <div className="col-sm-4">
                            <TeamCard {...data.primaryUserTeam.team} />
                        </div>
                        <div className="col-sm-8">
                        </div>
                    </div>
                </div>
            </>
        );
    }
}

const Error = () => {
    return (
        <>
            <h1>Error</h1>
        </>
    )
}

ReactDOM.render(
    <BrowserRouter>
        <App />
    </BrowserRouter>,
    document.getElementById('root')
);