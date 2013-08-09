        <h1>API</h1>

        <p>The API supports the following methods:</p>

        <table>
            <thead>
                <tr>
                    <td class="resource_column">Resource</td>
                    <td class="method_column">Method</td>
                    <td class="parameter_column">Parameters</td>
                    <td class="result_column">Result</td>
                </tr>
            </thead>
            <tbody>
                <!--
                    ********************************************************************
                    USER
                    ********************************************************************
                -->
                <tr class="resource_header">
                    <td class="resource_column">USER</td>
                    <td class="method_column"></td>
                    <td class="parameter_column"></td>
                    <td class="result_column"></td>
                </tr>
                <tr>
                    <td class="resource_column"></td>
                    <td class="method_column">getinfo</td>
                    <td class="parameter_column">
                        <ul>
                            <li>id (*)</li>
                            <li>username (*)</li>
                        </ul>
                        At least one of (*) is required.
                    </td>
                    <td class="result_column"></td>
                </tr>
                <tr>
                    <td class="resource_column"></td>
                    <td class="method_column">updateinfo</td>
                    <td class="parameter_column"></td>
                    <td class="result_column"></td>
                </tr>
                <tr>
                    <td class="resource_column"></td>
                    <td class="method_column">getquestions</td>
                    <td class="parameter_column"></td>
                    <td class="result_column"></td>
                </tr>
                <tr>
                    <td class="resource_column"></td>
                    <td class="method_column">register</td>
                    <td class="parameter_column"></td>
                    <td class="result_column"></td>
                </tr>
                <tr>
                    <td class="resource_column"></td>
                    <td class="method_column">delete</td>
                    <td class="parameter_column"></td>
                    <td class="result_column"></td>
                </tr>
                <tr>
                    <td class="resource_column"></td>
                    <td class="method_column">search</td>
                    <td class="parameter_column"></td>
                    <td class="result_column"></td>
                </tr>
                <tr>
                    <td class="resource_column"></td>
                    <td class="method_column">getskills</td>
                    <td class="parameter_column"></td>
                    <td class="result_column"></td>
                </tr>
                <tr>
                    <td class="resource_column"></td>
                    <td class="method_column">answers</td>
                    <td class="parameter_column"></td>
                    <td class="result_column"></td>
                </tr>
                <!--
                    ********************************************************************
                    SKILL
                    ********************************************************************
                -->
                <tr class="resource_header">
                    <td class="resource_column">SKILL</td>
                    <td class="method_column"></td>
                    <td class="parameter_column"></td>
                    <td class="result_column"></td>
                </tr>
                <tr>
                    <td class="resource_column"></td>
                    <td class="method_column">search</td>
                    <td class="parameter_column"></td>
                    <td class="result_column"></td>
                </tr>
                <tr>
                    <td class="resource_column"></td>
                    <td class="method_column">create</td>
                    <td class="parameter_column"></td>
                    <td class="result_column"></td>
                </tr>
                <tr>
                    <td class="resource_column"></td>
                    <td class="method_column">getquestions</td>
                    <td class="parameter_column"></td>
                    <td class="result_column"></td>
                </tr>
                <!--
                    ********************************************************************
                    QUESTION
                    ********************************************************************
                -->
                <tr class="resource_header">
                    <td class="resource_column">QUESTION</td>
                    <td class="method_column"></td>
                    <td class="parameter_column"></td>
                    <td class="result_column"></td>
                </tr>
                <tr>
                    <td class="resource_column"></td>
                    <td class="method_column">search</td>
                    <td class="parameter_column"></td>
                    <td class="result_column"></td>
                </tr>
                <tr>
                    <td class="resource_column"></td>
                    <td class="method_column">getanswers</td>
                    <td class="parameter_column"></td>
                    <td class="result_column"></td>
                </tr>
                <tr>
                    <td class="resource_column"></td>
                    <td class="method_column">getskills</td>
                    <td class="parameter_column"></td>
                    <td class="result_column"></td>
                </tr>
                <tr>
                    <td class="resource_column"></td>
                    <td class="method_column">create</td>
                    <td class="parameter_column"></td>
                    <td class="result_column"></td>
                </tr>
                <tr>
                    <td class="resource_column"></td>
                    <td class="method_column">getinfo</td>
                    <td class="parameter_column"></td>
                    <td class="result_column"></td>
                </tr>
                <tr>
                    <td class="resource_column"></td>
                    <td class="method_column">delete</td>
                    <td class="parameter_column"></td>
                    <td class="result_column"></td>
                </tr>
                <!--
                    ********************************************************************
                    ANSWER
                    ********************************************************************
                -->
                <tr class="resource_header">
                    <td class="resource_column">ANSWER</td>
                    <td class="method_column"></td>
                    <td class="parameter_column"></td>
                    <td class="result_column"></td>
                </tr>
                <tr>
                    <td class="resource_column"></td>
                    <td class="method_column">search</td>
                    <td class="parameter_column"></td>
                    <td class="result_column"></td>
                </tr>
                <tr>
                    <td class="resource_column"></td>
                    <td class="method_column">getquestion</td>
                    <td class="parameter_column"></td>
                    <td class="result_column"></td>
                </tr>
                <tr>
                    <td class="resource_column"></td>
                    <td class="method_column">create</td>
                    <td class="parameter_column"></td>
                    <td class="result_column"></td>
                </tr>
                <!--
                    ********************************************************************
                    AUTHENTICATION
                    ********************************************************************
                -->
                <tr class="resource_header">
                    <td class="resource_column">AUTHENTICATION</td>
                    <td class="method_column"></td>
                    <td class="parameter_column"></td>
                    <td class="result_column"></td>
                </tr>
                <tr>
                    <td class="resource_column"></td>
                    <td class="method_column">startsession</td>
                    <td class="parameter_column"></td>
                    <td class="result_column"></td>
                </tr>
                <tr>
                    <td class="resource_column"></td>
                    <td class="method_column">endsession</td>
                    <td class="parameter_column"></td>
                    <td class="result_column"></td>
                </tr>
            </tbody>
        </table>
