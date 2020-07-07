import '../base/common.js';

import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import UserCard from '../components/user/user_card';
import { useFetch } from '../inc/fetch';

const App = () => {
    const [data, loading, error] = useFetch('api_basic_data');

    if (error !== null) {
        console.log('error');
    } else if (!loading) {
        return <div>Loading...</div>
    } else {
        return (
            <>
                <div className="container">
                    <div className="col-sm-4">
                        <UserCard user={data.user} />
                    </div>
                </div>
            </>
        );
    }
}

ReactDOM.render(
    <App />,
    document.getElementById('root')
);