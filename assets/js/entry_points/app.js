import '../base/common.js';

import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import UserCard from '../components/user/user_card';

const App = () => {
    const [hasError, setErrors] = useState(false);
    const [basicData, setBasicData] = useState({});

    useEffect(() => {
        async function fetchData() {
            const result = axios(Routing.generate('api_basic_data'));

            console.log(result);

            setBasicData(result.data['data']);
        }
    
        fetchData();

        return () => {}
    }, [basicData]);

    function debug() {
        console.log(basicData.user);
        console.log(basicData.team);
    }

    return (
        <div>
            {/* <UserCard user={basicData.user} /> */}
            <button onClick={debug}>
                Log
            </button>
        </div>
    );
}

ReactDOM.render(
    <App />,
    document.getElementById('root')
);