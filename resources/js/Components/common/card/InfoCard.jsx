import React from "react";

const InfoCard = ({
    cardStyle,
    label,
    labelStyle,
    content,
    contentStyle,
    icon,
    headerStyle
}) => {
    return (
        <div className={`p-3 mb-3 ${cardStyle}`}>
            <div className={`flex items-center flex-row gap-2 ${headerStyle}`}>
                {icon}
                <h3 className={`font-bold text-gray-900 text-xl ${labelStyle}`}>
                    {label}
                </h3>
            </div>
            <p className={`my-3 text-[16px] ${contentStyle}`}>{content}</p>
        </div>
    );
};

export default InfoCard;
