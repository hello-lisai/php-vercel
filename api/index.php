<?php

function get_repository_files($repo_owner, $repo_name, $token) {
    $headers = array(
        "Authorization: Bearer $token",
        "User-Agent: PHP"
    );
    $url = "https://api.github.com/repos/$repo_owner/$repo_name/contents";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($status_code == 200) {
        $files = json_decode($response, true);
        foreach ($files as $file_data) {
            $file_name = $file_data["name"];
            echo $file_name . "\n";
        }
    } else {
        echo "Failed to retrieve repository files.\n";
    }
}

// 替换为你的 GitHub Token
$github_token = "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";

// 替换为你要查询的仓库的所有者和名称
$repository_owner = "hello-lisai";
$repository_name = "img";

get_repository_files($repository_owner, $repository_name, $github_token);
