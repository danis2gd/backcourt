import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';

const UserCard = (props) => {
    console.log(props);

    return (
        <div className="card page-block">
            <a href="#">
                <svg className="bd-placeholder-img card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="{{ user.username }}'s Logo">
                    <title>{props.name}'s Logo</title>
                    <rect width="100%" height="100%" fill="#868e96"></rect>
                    <text x="50%" y="50%" fill="#dee2e6" dy=".3em">
                        {props.name}'s Logo
                    </text>
                </svg>
            </a>
            <div className="card-body">
                <h5 className="card-title">{props.name}</h5>
                <p className="card-text">
                    {/* { props.role.map(role => {
                        return role
                    })} */}
                </p>
            </div>
        </div>
    );
};

export default UserCard;