import React, {useState, useEffect} from 'react';

const Block = (props) => {
    return (
        <div className="page-block">
            <div className="page-block-header">
                <h5>{props.title}</h5>
            </div>
            <div>
                <div className="page-block-content border border-grey border-top-0">
                    <div className="row">
                        <div className="col-md-12">
                            {props.content}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Block;